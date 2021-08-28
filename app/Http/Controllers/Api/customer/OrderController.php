<?php

namespace App\Http\Controllers\Api\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Repair;
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
        $length = 10;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        }

        $kode_order = 'ORD-'.Str::upper($random);

        $order = Order::create([
            'kode_order' => $kode_order,
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

    public function approve(Request $request, $id )
    {
        $repair = Repair::where('id',$id)->first();
        $repair->update([
            'approve_customer' => $request->approve_customer
        ]);
        if ($repair) {
            return response()->json([
                'success'   => true,
                'message'   => 'Success Update a Approve',
                'repair'   => $repair
            ]);
        }
        else {
            return response()->json([
                'success'   => false,
                'message'   => 'Failed Update a Approve',
            ]);
        }
    }

    public function updateDP(Request $request, $id)
    {
        $order = Order::where('id',$id)->first();
        $order->update([
            'down_payment' => $request->down_payment
        ]);
        if ($order) {
            return response()->json([
                'success'   => true,
                'message'   => 'Success Update DP',
                'repair'   => $order
            ]);
        }
        else {
            return response()->json([
                'success'   => false,
                'message'   => 'Failed Update DP',
            ]);
        }
    }
    
}