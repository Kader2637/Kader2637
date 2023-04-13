@extends('barang.master')
@section('judul')
Edit Barang - Toko
@endsection
@section('konten')
<div class="row">
<div class="col-md-12">
<div class="card border-0 shadow rounded">
<div class="card-body">
<form action="{{ route('barang.update', $barang->id) }}"
method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')


<div class="mb-3">
<label class="form-label fw-bold">Nama</label>
<input type="text" class="form-control
@error('nama') is-invalid @enderror" name="nama"
value="{{ old('nama', $barang->nama) }}"
placeholder="Masukkan Nama Barang">
<!-- error message untuk title -->
@error('nama')
<div class="alert alert-danger mt-2">
{{ $message }}
</div>
@enderror
</div>

<div class="mb-3">
<label class="form-label fw-bold">Kode
Barang</label>
<input type="text" class="form-control
@error('kode') is-invalid @enderror" name="kode"
value="{{ old('kode', $barang->kode) }}"
placeholder="Masukkan Kode Barang">
<!-- error message untuk title -->
@error('kode')
<div class="alert alert-danger mt-2">
Kode telah digunakan
</div>
@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Satuan</label>
    <div class="mb-3">
        <select name="satuan" class="form-select">
            <option value="kg" {{ old('satuan', $barang->satuan) == 'kg' ? 'selected' : '' }}>kg</option>
            <option value="box" {{ old('satuan', $barang->satuan) == 'box' ? 'selected' : '' }}>box</option>
            <option value="pcs" {{ old('satuan', $barang->satuan) == 'pcs' ? 'selected' : '' }}>pcs</option>
        </select>
        <!-- error message untuk satuan -->
        @error('satuan')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Gambar</label>
    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
    <!-- error message untuk Gambar -->
    @error('image')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
    @enderror
    @if ($barang->image)
        <div class="mt-2">
            <img src="{{ asset('storage/barang/' . $barang->image) }}" alt="{{ $barang->image }}" style="max-height: 100px;"/>
        </div>
    @endif
</div>

<div class="mb-3">
<label class="form-label fw-bold">Harga
Jual</label>
<input type="number" class="form-control
@error('jual') is-invalid @enderror" name="jual"
value="{{ old('jual', $barang->jual) }}"
placeholder="Masukkan Harga jual Barang">
<!-- error message untuk stok -->
@error('jual')
<div class="alert alert-danger mt-2">
{{ $message }}
</div>
@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Harga
    Beli</label>
    <input type="number" class="form-control
    @error('beli') is-invalid @enderror" name="beli"
    value="{{ old('beli', $barang->beli) }}"
    placeholder="Masukkan Harga beli Barang">
    <!-- error message untuk stok -->
    @error('beli')
    <div class="alert alert-danger mt-2">
    {{ $message }}
    </div>
    @enderror
    </div>

<div class="mb-3">
<label class="form-label fw-bold">Stok
Barang</label>
<input type="number" class="form-control
@error('stok') is-invalid @enderror" name="stok"
value="{{ old('stok', $barang->stok) }}"
placeholder="Masukkan Stok Barang">
<!-- error message untuk stok -->
@error('stok')
<div class="alert alert-danger mt-2">
{{ $message }}
</div>
@enderror
</div>
<button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
<button type="reset" class="btn btn-md btn-danger">RESET</button>
<a href="{{ route('barang.index') }}" class="btn btn-md btn-warning">KEMBALI</a>
</form>
</div>
</div>
</div>
</div>
@endsection
