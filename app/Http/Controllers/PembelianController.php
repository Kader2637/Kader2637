<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $pembelians = Pembelian::latest()->paginate(5);
        return view('pembelian.index', compact('pembelians', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barangs = Barang::all();
        $suppliers = Supplier::all();
        return view('pembelian.create', compact('barangs', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama' => 'required',
                'produk' => 'required',
                'tgl' => 'required|date_format:Y-m-d',
                'stok' => 'required|numeric|min:1',
            ],
            [
                'tgl.date_format' => 'Format tanggal tidak valid !',
                'tgl.required' =>'Tanggal tidak boleh kosong',
                'tgl.after' => 'Tanggal pembelian tidak dapat melebihi tanggal sekarang'
            ],
        );

        $barang = Barang::where('nama', $request->produk)->first();

        if (!$barang) {
            return redirect()
                ->back()
                ->with(['error' => 'Barang tidak ditemukan!']);
        }

        $tgl_formatted = date('d-m-Y', strtotime($request->tgl));

        if (strtotime($request->tgl) > time()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['tgl' => 'Tanggal pembelian tidak valid']);
        }

        $pembelian = Pembelian::create([
            'nama' => $request->nama,
            'produk' => $request->produk,
            'tgl' => $tgl_formatted,
            'stok' => $request->stok,
        ]);

        $barang->stok += (int) $request->stok;
        $barang->save();

        return redirect()
            ->route('pembelian.index')
            ->with(['success' => 'Data Berhasil Disimpan!']);
    }
    //     public function store(Request $request)
    //     {
    //         $this->validate($request, [
    //             'nama' => 'required',
    //             'produk' => 'required',
    //             'tgl' => 'required|date_format:Y-m-d',
    //             'stok' => 'required|numeric|min:1',
    //         ], [
    //             'tgl.date_format' => 'Format tanggal tidak valid !'
    //         ]);

    //         $barang = Barang::where('nama', $request->produk)->first();

    //         if (!$barang) {
    //             return redirect()->back()->with(['error' => 'Barang tidak ditemukan!']);
    //         }

    //         $tgl_formatted = date('d-m-Y', strtotime($request->tgl));
    //         $pembelian = Pembelian::create([
    //             'nama' => $request->nama,
    //             'produk' => $request->produk,
    //             'tgl' => $tgl_formatted,
    //             'stok' => $request->stok
    //         ]);

    //         $barang->stok += (int) $request->stok;
    //         $barang->save();

    //         return redirect()->route('pembelian.index')->with(['success' => 'Data Berhasil Disimpan!']);
    //     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelian $pembelian)
    {
        $suppliers = Supplier::all();
        $barangs = Barang::all();
        return view('pembelian.edit', compact('pembelian', 'suppliers', 'barangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //validate form
        $this->validate(
            $request,
            [
                'nama' => 'required',
                'produk' => 'required',
                'tgl' => 'required|date_format:Y-m-d',
                'stok' => 'required|numeric|min:1',
            ],
            [
                'tgl.date_format' => 'Format tanggal tidak valid !',
                'stok.numeric' => 'Stok harus berupa angka !',
                'stok.min' => 'Stok tidak boleh kurang dari 1 !',
            ],
        );

        $barang = Barang::where('nama', $pembelian->produk)->first();
        if (!$barang) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Barang tidak ditemukan']);
        }

        $oldStok = $pembelian->stok;
        $newStok = $request->stok;

        $tgl_formatted = date('d-m-Y', strtotime($request->tgl));

        // Membandingkan tanggal yang dimasukkan dengan tanggal sekarang
        if (strtotime($request->tgl) > time()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['tgl' => 'Tanggal pembelian tidak valid']);
        }

        $pembelian->update([
            'nama' => $request->nama,
            'produk' => $request->produk,
            'tgl' => $tgl_formatted,
            'stok' => $newStok,
        ]);

        $selisihStok = $newStok - $oldStok;

        $barang->stok += $selisihStok;
        $barang->save();

        //redirect to index
        return redirect()
            ->route('pembelian.index')
            ->with(['success' => 'Data Berhasil Diubah!']);
    }

    //     public function update(Request $request, Pembelian $pembelian)
    // {
    //     //validate form
    //     $this->validate($request, [
    //         'nama' => 'required',
    //         'produk' => 'required',
    //         'tgl' => 'required|date_format:Y-m-d',
    //         'stok' => 'required|numeric|min:1',
    //     ], [
    //         'tgl.date_format' => 'Format tanggal tidak valid !',
    //         'stok.numeric' => 'Stok harus berupa angka !',
    //         'stok.min' => 'Stok tidak boleh kurang dari 1 !',
    //     ]);

    //     $barang = Barang::where('nama', $pembelian->produk)->first();
    //     if (!$barang) {
    //         return redirect()->back()->withErrors(['error' => 'Barang tidak ditemukan']);
    //     }

    //     $oldStok = $pembelian->stok;
    //     $newStok = $request->stok;

    //     $tgl_formatted = date('d-m-Y', strtotime($request->tgl));
    //     $pembelian->update([
    //         'nama' => $request->nama,
    //         'produk' => $request->produk,
    //         'tgl' => $tgl_formatted,
    //         'stok' => $newStok,
    //     ]);

    //     $selisihStok = $newStok - $oldStok;

    //     $barang->stok += $selisihStok;
    //     $barang->save();

    //     //redirect to index
    //     return redirect()->route('pembelian.index')->with(['success' => 'Data Berhasil Diubah!']);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        $barang = Barang::where('nama', $pembelian->produk)->first();
        if (!$barang) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Barang tidak ditemukan']);
        }

        $barang->stok -= $pembelian->stok;
        $barang->save();

        $pembelian->delete();

        //redirect to index
        return redirect()
            ->route('pembelian.index')
            ->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
