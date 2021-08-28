<?php

namespace App\Http\Controllers\Api\teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teknisi-api');
    }

    public function index()
    {
        $cart = Cart::with('product')
            ->where('reseller_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();


        return response()->json([
            'success' => true,
            'message' => 'List Data cart',
            'cart'    => $cart
        ]);
    }

    public function store(Request $request)
    {
        $item = Cart::where('product_id',$request->product_id)->where('order_id',$request->order_id)->where('teknisi_id', $request->teknisi_id);

        if ($item->count()) {
            $item->increment('qty');
            $item = $item->first();
            $price = $request->price * $item->quantity;
            $item->update([
                'price' => $price
            ]);
        } else{
            $pricetotal = $request->quantity * $request->price;

            $item = Cart::create([
                'order_id' => $request->order_id,
                'product_id'    => $request->product_id,
                'reseller_id'   => $request->reseller_id,
                'quantity'      => $request->quantity,
                'price'         => $pricetotal,
            ]);
        }
    }

    public function removeCart(Request $request)
    {
        Cart::with('product')
                ->whereId($request->cart_id)
                ->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Remove Item Cart',
        ]);
    }
    
    /**
     * removeAllCart
     *
     * @param  mixed $request
     * @return void
     */
    public function removeAllCart(Request $request)
    {
        Cart::with('product')
                ->where('teknisi', auth()->guard('teknisi-api')->user()->id)
                ->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Remove All Item in Cart',
        ]);
    }
}
