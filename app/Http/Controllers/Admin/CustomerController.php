<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::latest()->when(request()->q, function($customer) {
            $customer = $customer->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);
        return view('admin.customer.index',compact('customer'));
    }
}
