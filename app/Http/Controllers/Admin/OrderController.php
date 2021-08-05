<?php

namespace App\Http\Controllers\Admin;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $invoices = Invoice::latest()->when(request()->q, function($invoices) {
            $invoices = $invoices->where('invoice', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.order.index', compact('invoices'));
    }
  
    
    /**
     * show
     *
     * @param  mixed $invoice
     * @return void
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.order.show', compact('invoice'));
    }
    public function update(Request $request, Invoice $invoice)
    {
       $invoice = Invoice::findOrFail($request->id);
     
        $this->validate($request, [
            'status'       => 'required',
        ]); 

        $invoice->update([
            'status'       => $request->status
        ]);
        if($invoice){
            //redirect dengan pesan sukses //must redirect with parameter !!!!!!!
            return redirect()->route('admin.order.index')->with(['success' => 'Data Order Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.order.index')->with(['error' => 'Data Gagal Diupdate!']);
        }

    }
    public function destroy($id)
    {
        $product = Invoice::findOrFail($id);
        
        $product->delete();

        if($product){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
