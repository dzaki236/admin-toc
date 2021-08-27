<?php

namespace App\Http\Controllers\Api\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['register', 'login']);
    } 
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'phone' => 'required',
            'photo'          => 'required|image|mimes:jpeg,jpg,png|max:10000',
            'email'    => 'required|email|unique:customers',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $image = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->move(public_path('upload/customer'), $image);

        $customer = Customer::create([
            'name'      => $request->name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'photo'     =>'http://localhost:8000/upload/customer/' . $image,
            'password'  => Hash::make($request->password)
        ]);

        $token = JWTAuth::fromUser($customer);

        if($customer) {
            return response()->json([
                'success' => true,
                'customer'    => $customer,  
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

        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email or Password is incorrect'
            ], 401);
        }
        return response()->json([
            'success' => true,
            'customer'    => auth()->guard('api')->user(),  
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
            'customer'    => auth()->user()
        ], 200);
    }
}
