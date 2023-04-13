<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Pembelian;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

/**
 * Summary of GraphController
 */
class GraphController extends Controller
{
    public function showMap()
    {
        $penjualan = Penjualan::all();
        $totalStokPenjualan = 0;
        foreach ($penjualan as $data) {
            $totalStokPenjualan += $data->stok;
        }
        $pembelian = Pembelian::all();
        $totalStokPembelian = 0;
        foreach ($pembelian as $data) {
            $totalStokPembelian += $data->stok;
        }
        $lastStokPenjualan = Penjualan::orderBy('id', 'desc')->first();
        $lastStokPenjualan = ($lastStokPenjualan != null) ? $lastStokPenjualan->stok : 0;
        $lastStokPembelian = Pembelian::orderBy('id', 'desc')->first();
        $lastStokPembelian = ($lastStokPembelian != null) ? $lastStokPembelian->stok : 0;
        $lastPembelian = Pembelian::orderBy('id', 'desc')->first();
        $request = session()->get('request');
        if ($lastPembelian && $request) {
            if ($lastPembelian->id == $request['id']) {
                $lastStokPembelian = $lastStokPembelian - $request['stok_lama'] + $request['stok'];
            } else {
                $lastStokPembelian = $lastStokPembelian - $lastPembelian->stok + $request['stok'];
            }
        }


        $label = ['Penjualan', 'Pembelian'];
        $price = [$totalStokPenjualan, $totalStokPembelian];

        $totalchart = [$totalStokPenjualan + $totalStokPembelian];
        session()->put('lastStokPenjualan', $lastStokPenjualan);
        session()->put('lastStokPembelian', $lastStokPembelian);

        return view('showMap', ['labels' => $label, 'prices' => $price, 'totalchart' => $totalchart]);
    }

    /**
     * Summary of destroy
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::find($id);
        $barang = Barang::where('nama', $penjualan->nama)->first();
        $barang->stok += $penjualan->stok;
        $barang->save();
        $penjualan->delete();

        //update grafik
        return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
