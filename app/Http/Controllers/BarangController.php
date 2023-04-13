<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $barangs = Barang::latest()->paginate(5);
        return view('barang.index', compact('barangs','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
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
            'kode' => 'required|unique:barangs',
            'satuan' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jual' => 'required',
            'beli' => 'required',
            'stok' => 'required|numeric'
            ]);
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/barang', $image->hashName());
            //create post
            Barang::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'satuan' => $request->satuan,
            'image' => $image->hashName(),
            'jual' => $request->jual,
            'beli' => $request->beli,
            'stok' => $request->stok
            ]);
            //redirect to index
            return redirect()->route('barang.index')->with(['success' => 'Data
           Berhasil Disimpan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        //validate form
 $this->validate($request, [
    'nama' => 'required',
    'kode' => 'required|unique:barangs,kode,' . $barang->id,
    'satuan' => 'required',
    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'jual' => 'required|numeric',
    'beli' => 'required|numeric',
    'stok' => 'required|numeric'
    ]);
    //check if image is uploaded
    if ($request->hasFile('image')) {
    //upload new image
    $image = $request->file('image');
    $image->storeAs('public/barang', $image->hashName());
    //delete old image
    Storage::delete('public/barang/'.$barang->image);
    //update post with new image
    $barang->update([
    'nama' => $request->nama,
    'kode' => $request->kode,
    'satuan' => $request->satuan,
    'image' => $image->hashName(),
    'jual' => $request->jual,
    'beli' => $request->beli,
    'stok' => $request->stok,
    ]);
    } else {
    //update post without image
    $barang->update([
    'nama' => $request->nama,
    'kode' => $request->kode,
    'satuan' => $request->satuan,
    'jual' => $request->jual,
    'beli' => $request->beli,
    'stok' => $request->stok,
    ]);
    }
    //redirect to index
    return redirect()->route('barang.index')->with(['success' => 'Data
   Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        //delete image
 Storage::delete('public/barang/'. $barang->image);
 //delete post
 $barang->delete();
 //redirect to index
 return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('welcome');
    }

}
?>
