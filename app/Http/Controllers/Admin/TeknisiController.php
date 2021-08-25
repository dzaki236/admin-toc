<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teknisi;

class TeknisiController extends Controller
{
    public function index()
    {
        $teknisi = Teknisi::latest()->when(request()->q, function($teknisi) {
            $teknisi = $teknisi->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);
        return view('admin.teknisi.index',compact('teknisi'));
    }

    public function create()
    {
        return view('admin.teknisi.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'photo'          => 'required|image|mimes:jpeg,jpg,png|max:10000',
            'name'       => 'required',
            'phone'       => 'required',
            'email'      => 'required|email|unique:teknisis',
            'password'   => 'required|confirmed' 
        ]); 
 
        //upload image
        $image = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->move(public_path('upload/teknisi'), $image);
        //save to DB
        $teknisi = Teknisi::create([
            'photo'          => $image,
            'name'          => $request->name,
            'email'       => $request->email,
            'phone'           => $request->phone,
            'password'   => bcrypt($request->password),
        ]);
 
        if($teknisi){
             //redirect dengan pesan sukses
             return redirect()->route('admin.teknisi.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.teknisi.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    public function edit($id)
    {
        $teknisi = Teknisi::find($id);
        return view('admin.teknisi.edit',compact('teknisi'));
    }

    public function update(Request $request, $id )
    {
        if($request->hasFile('photo')) {
            $image = $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('upload/teknisi'), $image);


            //update tanpa image
            $teknisi = Teknisi::findOrFail($id);
            $teknisi->update([
                'photo'          => $image,
                'name'          => $request->name,
                'email'       => $request->email,
                'phone'           => $request->phone,
                'password'   => bcrypt($request->password),
            ]);

            if($teknisi){
                //redirect dengan pesan sukses
                return redirect()->route('admin.teknisi.index')->with(['success' => 'Data Berhasil Disimpan!']);
                }else{
                    //redirect dengan pesan error
                    return redirect()->route('admin.teknisi.index')->with(['error' => 'Data Gagal Disimpan!']);
                }

       } else {
            //update dengan image
            $teknisi = Teknisi::findOrFail($id);
            $teknisi->update([
                'name'          => $request->name,
                'email'       => $request->email,
                'phone'           => $request->phone,
                'password'   => bcrypt($request->password),
            ]);

            if($teknisi){
                //redirect dengan pesan sukses
                return redirect()->route('admin.teknisi.index')->with(['success' => 'Data Berhasil Disimpan!']);
                }else{
                    //redirect dengan pesan error
                    return redirect()->route('admin.teknisi.index')->with(['error' => 'Data Gagal Disimpan!']);
                }
       }
       
    }
    public function destroy($id)
    {
        $teknisi = Teknisi::findOrFail($id);
        $teknisi->delete();

        if($teknisi){
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
