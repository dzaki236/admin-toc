<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::latest()->when(request()->q, function($customer) {
            $customer = $customer->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);
        return view('admin.customer.index',compact('customer'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'photo'          => 'required|image|mimes:jpeg,jpg,png|max:10000',
            'name'       => 'required',
            'phone'       => 'required',
            'email'      => 'required|email|unique:customers',
            'password'   => 'required|confirmed' 
        ]); 
 
        //upload image
       $image = $request->file('photo');
       $image->storeAs('public/customers', $image->hashName());

      //  $request->file('photo')->move(public_path('upload/teknisi'), $image);
        //save to DB
        $customer = Customer::create([
            'name'          => $request->name,
            'photo'          => $image->hashName(),
            'phone'           => $request->phone,
            'email'       => $request->email,
            'password'   => bcrypt($request->password),
        ]);
 
        if($customer){
             //redirect dengan pesan sukses
             return redirect()->route('admin.customer.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.customer.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

}
