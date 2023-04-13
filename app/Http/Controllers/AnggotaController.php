<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggotas = Anggota::latest()->paginate(5);
        return view('anggota.index', compact('anggotas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anggota.create');
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
            'jenis_kelamin' => 'required',
            'jabatan' => 'required'
            ]);

            Anggota::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan
            ]);
            //redirect to index
            return redirect()->route('anggota.index')->with(['success' => 'Data
           Berhasil Disimpan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anggota $anggota)
    {
        //validate form
 $this->validate($request, [
    'nama' => 'required',
    'jenis_kelamin' => 'required',
    'jabatan' => 'required'
    ]);

    $anggota->update([
    'nama' => $request->nama,
    'jenis_kelamin' => $request->jenis_kelamin,
    'jabatan' => $request->jabatan,
    ]);

    //update post without image
    $anggota->update([
    'nama' => $request->nama,
    'jenis_kelamin' => $request->jenis_kelamin,
    'jabatan' => $request->jabatan,
    ]);

    //redirect to index
    return redirect()->route('anggota.index')->with(['success' => 'Data
   Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anggota $anggota)
    {
 //redirect to index
 return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
?>
