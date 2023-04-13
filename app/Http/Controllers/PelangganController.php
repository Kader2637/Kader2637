<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $pelanggans = Pelanggan::latest()->paginate(5);
        return view('pelanggan.index', compact('pelanggans','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggan.create');
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
            'jk' => 'required',
            'alamat' => 'required'
            ]);

            Pelanggan::create([
            'nama' => $request->nama,
            'jk' => $request->jk,
            'alamat' => $request->alamat
            ]);
            //redirect to index
            return redirect()->route('pelanggan.index')->with(['success' => 'Data
           Berhasil Disimpan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        //validate form
 $this->validate($request, [
    'nama' => 'required',
    'jk' => 'required',
    'alamat' => 'required',
    ]);

    $pelanggan->update([
    'nama' => $request->nama,
    'jk' => $request->jk,
    'alamat' => $request->alamat,
    ]);

    //update post without image
    $pelanggan->update([
    'nama' => $request->nama,
    'jk' => $request->jk,
    'alamat' => $request->alamat,
    ]);

    //redirect to index
    return redirect()->route('pelanggan.index')->with(['success' => 'Data
   Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
    //redirect to index
    return redirect()->route('pelanggan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
?>
