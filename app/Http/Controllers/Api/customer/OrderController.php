<?php

namespace App\Http\Controllers\Api\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_id',auth()->guard('api')->user()->id)->latest()->get();
        return response()->json([
            'success'   => true,
            'message'   => 'List Data Order',
            'order'  => $orders
        ],200);
    }

    public function order(Request $request)
    {
        // $customer = Customer::where('id',auth()->guard('api')->user()->id);

        $order = Order::create([
            'customer_id' => auth()->guard('api')->user()->id,
            'name' => $request->name,
            'device' => $request->device,
            'order_call' => $request->order_call,
            'description' => $request->description,
            'alamat' => $request->alamat,
            'cost_transport' => $request->cost_transport,
            'down_payment' => $request->down_payment,
            'status' => 'menunggu'
        ]);

        if ($order) {
            return response()->json([
                'success'   => true,
                'message'   => 'Success Make a Order',
                'order'   => $order
            ]);
        }
        else {
            return response()->json([
                'success'   => false,
                'message'   => 'Failed Make a Order',
            ]);
        }
    }
}
