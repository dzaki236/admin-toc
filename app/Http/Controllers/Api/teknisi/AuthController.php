<?php

namespace App\Http\Controllers\Api\teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Teknisi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teknisi-api')->except(['register', 'login']);
    } 
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'phone' => 'required',
            'photo'          => 'required|image|mimes:jpeg,jpg,png|max:10000',
            'email'    => 'required|email|unique:teknisis',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $image = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->move(public_path('upload/bukti'), $image);

        $teknisi = Teknisi::create([
            'name'      => $request->name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'photo'     =>'http://localhost:8000/upload/teknisi/' . $image,
            'password'  => Hash::make($request->password)
        ]);

        $token = JWTAuth::fromUser($teknisi);

        if($teknisi) {
            return response()->json([
                'success' => true,
                'teknisi'    => $teknisi,  
                'token'   => $token  
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }
    
    /**
     * login
     *
     * @param  mixed $request
     * @return void
     */
    public function login(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $credentials = $request->only('email', 'password');

        if(!$token = auth()->guard('teknisi-api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email or Password is incorrect'
            ], 401);
        }
        return response()->json([
            'success' => true,
            'teknisi'    => auth()->guard('teknisi-api')->user(),  
            'token'   => $token   
        ], 201);
    }
    
    /**
     * getUser
     *
     * @return void
     */
    public function getUser()
    {
        return response()->json([
            'success' => true,
            'teknisi'    => auth()->user()
        ], 200);
    }
}
