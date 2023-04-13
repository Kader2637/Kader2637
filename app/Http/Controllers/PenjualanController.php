<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $penjualans = Penjualan::latest()->paginate(5);
        return view('penjualan.index', compact('penjualans','user'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barangs=Barang::all();
        return view('penjualan.create', compact('barangs'));
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
        'harga' => 'required',
        'stok' => 'required',
    ]);

       if ($request->stok == 0) {
        return redirect()->back()->with(['error' => 'Silahkan input data stok dengan benar !']);
    }

    $barang = Barang::where('nama', $request->nama)->first();

    if ($request->stok > $barang->stok) {
        return redirect()->back()->with(['error' => 'Stok barang tidak mencukupi!']);
    }

    $harga = $request->harga;
    $stok = $request->stok;
    $jumlah = $harga * $stok;

    $penjualan = Penjualan::create([
        'nama' => $request->nama,
        'harga' => $harga,
        'stok' => $stok,
        'jumlah' => $jumlah
    ]);

    $barang->stok -= $request->stok;
    $barang->save();

    //redirect to index
    return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil Disimpan!']);
}



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        $barangs = Barang::all();
        return view('penjualan.edit', compact('penjualan', 'barangs'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */

public function update(Request $request, Penjualan $penjualan)
{
    //validate form
    $this->validate($request, [
        'nama' => 'required',
        'harga' => 'required',
        'stok' => 'required|numeric|min:0',
    ]);


    if ($request->stok == 0) {
        return redirect()->back()->with(['error' => 'Data stok tidak valid!']);
    }

    $barang = Barang::where('nama', $request->nama)->first();
    $stok_terbaru = $barang->stok + $penjualan->stok - $request->stok;


    if ($stok_terbaru < 0) {
        $stok_terbaru = 0;
        $request->stok = $barang->stok + $penjualan->stok;
        return redirect()->back()->with(['error' => 'Stok barang tidak mencukupi!']);
    }

    $harga_lama = $penjualan->harga;
    $stok_lama = $penjualan->stok;
    $jumlah_lama = $harga_lama * $stok_lama;

    $harga_baru = $request->harga;
    $stok_baru = $request->stok;
    $jumlah_baru = $harga_baru * $stok_baru;

    $penjualan->update([
        'nama' => $request->nama,
        'harga' => $harga_baru,
        'stok' => $stok_baru,
        'jumlah' => $jumlah_baru,
    ]);


    $barang->update([
        'stok' => $stok_terbaru,
    ]);

    return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil Diubah!']);
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        $barang = Barang::where('nama', $penjualan->nama)->first();
        if (!$barang) {
            return redirect()->back()->withErrors(['error' => 'Barang tidak ditemukan']);
        }

        $barang->stok += $penjualan->stok;
        $barang->save();

        $penjualan->delete();

        //redirect to index
        return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
?>
