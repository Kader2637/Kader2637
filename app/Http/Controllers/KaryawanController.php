<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $karyawans = Karyawan::latest()->paginate(5);
        return view('karyawan.index', compact('karyawans','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.create');
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
            'no' => 'required|unique:karyawans|max:14|min:12',
            'jabatan' => 'required'
        ], [
            'no.unique' => 'Nomor telepon sudah digunakan',
            'no.max' => 'Nomor telepon tidak valid',
            'no.min' => 'Nomor telephone tidak valid'
        ]);

        Karyawan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no' => $request->no,
            'jabatan' => $request->jabatan
        ]);

        return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        //validate form
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'no' => 'required|unique:karyawans,no,'.$karyawan->id.'|max:14|min:12',
            'jabatan' => 'required',
        ], [
            'no.unique' => 'Nomor telepon sudah digunakan',
            'no.max' => 'Nomor telephone tidak valid',
            'no.min'=> 'Nomor telephone tidak valid'
        ]);


    $karyawan->update([
    'nama' => $request->nama,
    'alamat' => $request->alamat,
    'no' => $request->no,
    'jabatan' => $request->jabatan,
    ]);

    //update post without image
    $karyawan->update([
    'nama' => $request->nama,
    'alamat' => $request->alamat,
    'no' => $request->no,
    'jabatan' => $request->jabatan,
    ]);

    //redirect to index
    return redirect()->route('karyawan.index')->with(['success' => 'Data
   Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        //redirect to index
        return redirect()->route('karyawan.index')->with('status', [
            'type' => 'success',
            'message' => 'Data berhasil dihapus!'
        ]);
    }

}
?>
