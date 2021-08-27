<?php

namespace App\Http\Controllers\Api\teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repair;

class RepairController extends Controller
{
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
            'product_id' => $request->product_id,
            'component' => $request->component,
            'feedback_teknisi' => $request->feedback_teknisi,
            'deskripsi_tindakan' => $request->deskripsi_tindakan,
            'approval_customer' => 'menunggu',
            'status' => 'menunggu',
            'message' => 'menunggu konfirmasi customer'
        ]);

        if ($repair) {
            return response()->json([
                'success'   => true,
                'message'   => 'Success Make a repair',
                'repair'   => $repair
            ]);
        }
        else {
            return response()->json([
                'success'   => false,
                'message'   => 'Failed Make a Repair',
            ]);
        }
    }
}
