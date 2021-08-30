<?php

namespace App\Http\Controllers\Api\teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repair;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Component;

class RepairController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teknisi-api');
    }
    
    public function index()
    {
        $repair = Repair::where('teknisi_id',auth()->guard('teknisi-api')->user()->id)->latest()->get();
        return response()->json([
            'success'   => true,
            'message'   => 'List Data Repair',
            'repair'  => $repair
        ],200);
    }

    public function repair(Request $request)
    {
        $repair = Repair::create([
            'teknisi_id' => auth()->guard('teknisi-api')->user()->id,
            'order_id' => $request->order_id,
            'jasa_teknisi' => $request->jasa_teknisi,
            'total_component' => $request->total_component,
            'feedback_teknisi' => $request->feedback_teknisi,
            'deskripsi_tindakan' => $request->deskripsi_tindakan,
            'approval_customer' => 'menunggu',
            'status' => 'menunggu',
            'message' => 'menunggu konfirmasi customer'
        ]);

        if ($repair) {
            $item = Cart::where('order_id',$request->order_id)->where('teknisi_id', auth()->guard('teknisi-api')->user()->id)->get();
            if ($item->count()) {
                foreach($item as $value){
                    $produk = Product::where('id',$value->product_id)->first();
                    $data = array(
                        'order_id'    => $value->order_id,
                        'product_id'    => $value->product_id,
                        'name'  => $value->product->title,
                        'image'         => $value->product->image,
                        'qty'           => $value->quantity,
                        'price'         => $produk->price,
                        'total_price'         => $value->price,
                    );
                $component = Component::create($data);
            }
            return response()->json([
                'success'   => true,
                'message'   => 'Success Make a repair',
                'repair'   => $repair,
            ]);
          }
        //   else{
        //     return response()->json([
        //         'success'   => true,
        //         'message'   => 'Success Make a repair',
        //         'repair'   => $repair,
        //     ]);
        //   }
        }
        else {
            return response()->json([
                'success'   => false,
                'message'   => 'Failed Make a Repair',
            ]);
        }
 }

    public function update(Request $request, $id)
    {
        $repair = Repair::where('id',$id)->first();
        $repair->update([
            'jasa_teknisi' => $request->jasa_teknisi,
            'total_component' => $request->total_component,
            'feedback_teknisi' => $request->feedback_teknisi,
            'deskripsi_tindakan' => $request->deskripsi_tindakan,
            'status' => $request->status,
        ]);
    if ($repair) {
        return response()->json([
            'success'   => true,
            'message'   => 'Success Update a repair',
            'repair'   => $repair
        ]);
    }
    else {
        return response()->json([
            'success'   => false,
            'message'   => 'Failed Update a Repair',
        ]);
    }
    
    }
}
