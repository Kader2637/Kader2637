<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $customers = Customer::latest()->paginate(5);
        return view('customer.index', compact('customers','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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

            Customer::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan
            ]);
            //redirect to index
            return redirect()->route('customer.index')->with(['success' => 'Data
           Berhasil Disimpan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //validate form
 $this->validate($request, [
    'nama' => 'required',
    'jenis_kelamin' => 'required',
    'jabatan' => 'required'
    ]);

    $customer->update([
    'nama' => $request->nama,
    'jenis_kelamin' => $request->jenis_kelamin,
    'jabatan' => $request->jabatan,
    ]);

    //update post without image
    $customer->update([
    'nama' => $request->nama,
    'jenis_kelamin' => $request->jenis_kelamin,
    'jabatan' => $request->jabatan,
    ]);

    //redirect to index
    return redirect()->route('customer.index')->with(['success' => 'Data
   Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
    //redirect to index
    return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
?>
