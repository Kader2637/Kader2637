@extends('barang.master')
@section('judul')
Tambah Barang - Toko
@endsection
@section('konten')
<div class="row">
<div class="col-md-12">
<div class="card border-0 shadow rounded">
<div class="card-body">
<form action="{{ route('barang.store') }}" method="POST"
enctype="multipart/form-data">
@csrf
<div class="mb-3">
<label class="form-label fw-bold">Nama Barang</label>
<input type="text" class="form-control
@error('nama') is-invalid @enderror" name="nama"
value="{{ old('nama') }}"
placeholder="Masukkan Nama">
<!-- error message untuk title -->
@error('nama')
<div class="alert alert-danger mt-2">
{{ $message }}
</div>
@enderror
</div>

<div class="mb-3">
<label class="form-label fw-bold">Kode</label>
<input type="text" class="form-control
@error('kode') is-invalid @enderror" name="kode"
value="{{ old('kode') }}"
placeholder="Masukkan Kode Barang">
<!-- error message untuk NAMA -->
@error('kode')
<div class="alert alert-danger mt-2">
Kode telah di gunakan
</div>
@enderror
</div>

<div class="mb-3">
<label class="form-label fw-bold">Satuan</label>
<div class="mb-3">
<select name="satuan" class="form-select">
    <option value="" disabled selected>Pilih satuan</option>
    <option value="kg">kg</option>
    <option value="box">box</option>
    <option value="pcs">pcs</option>
</select>
<!-- error message untuk stok -->
@error('satuan')
<div class="alert alert-danger mt-2">
{{ $message }}
</div>
@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">GAMBAR</label>
    <input type="file" class="form-control
    @error('image') is-invalid @enderror" name="image">
    <!-- error message untuk image -->
    @error('image')
    <div class="alert alert-danger mt-2">
    {{ $message }}
    </div>
    @enderror
    </div>

<div class="mb-3">
<label class="form-label fw-bold">Harga jual</label>
<input type="number" class="form-control
@error('jual') is-invalid @enderror" name="jual"
value="{{ old('jual') }}"
placeholder="Masukkan Harga Jual">
<!-- error message untuk stok -->
@error('jual')
<div class="alert alert-danger mt-2">
{{ $message }}
</div>
@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Harga beli</label>
    <input type="number" class="form-control
    @error('beli') is-invalid @enderror" name="beli"
    value="{{ old('beli') }}"
    placeholder="Masukkan Harga Beli">
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
value="{{ old('stok') }}"
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
@section('skrip')
<script
src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('content');
</script>
@endsection
