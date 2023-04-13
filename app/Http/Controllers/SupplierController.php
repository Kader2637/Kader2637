<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $suppliers = Supplier::latest()->paginate(5);
        return view('supplier.index', compact('suppliers','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'no' => 'required|unique:suppliers|max:14|min:12',
            'jk' => 'required',
        ], [
            'no.unique' => 'Nomor telepon sudah digunakan',
            'no.max' => 'Nomor telephone tidak valid',
            'no.min' => 'Nomor telephone tidak valid'
        ]);


            Supplier::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no' => $request->no,
            'jk' => $request->jk
            ]);
            //redirect to index
            return redirect()->route('supplier.index')->with(['success' => 'Data
           Berhasil Disimpan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //validate form
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'no' => 'required|unique:suppliers,no,'.$supplier->id.'|max:14|min:12',
            'jk' => 'required',
        ], [
            'no.unique' => 'Nomor telepon sudah digunakan',
            'no.max' => 'Nomor telephone tidak valid',
            'no.min'=> 'Nomor telephone tidak valid'
        ]);


    $supplier->update([
    'nama' => $request->nama,
    'alamat' => $request->alamat,
    'no' => $request->no,
    'jk' => $request->jk,
    ]);

    //update post without image
    $supplier->update([
    'nama' => $request->nama,
    'alamat' => $request->alamat,
    'no' => $request->no,
    'jk' => $request->jk,
    ]);

    //redirect to index
    return redirect()->route('supplier.index')->with(['success' => 'Data
   Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
    //redirect to index
    return redirect()->route('supplier.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('welcome');
    }

}
?>
