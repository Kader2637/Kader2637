@extends('karyawan.master')
@section('judul')
Tambah karyawan - Toko
@endsection
@section('konten')
<div class="row">
<div class="col-md-12">
<div class="card border-0 shadow rounded">
<div class="card-body">
<form action="{{ route('karyawan.store') }}" method="POST"
enctype="multipart/form-data">
@csrf

<div class="mb-3">
<label class="form-label fw-bold">Nama karyawan</label>
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
    <label class="form-label fw-bold">Alamat</label>
    <input type="text" class="form-control
    @error('alamat') is-invalid @enderror" name="alamat"
    value="{{ old('alamat') }}"
    placeholder="Masukkan Alamat">
    <!-- error message untuk title -->
    @error('alamat')
    <div class="alert alert-danger mt-2">
    {{ $message }}
    </div>
    @enderror
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">No Telephone</label>
        <input type="number" class="form-control
@error('no') is-invalid @enderror" name="no" value="{{ old('no') }}" placeholder="Masukkan no">
        <!-- error message untuk title -->
        @error('no')
        <div class="alert alert-danger mt-2">
            {{ $message  }}
        </div>
        @enderror
    </div> 

        <div class="mb-3">
            <label class="form-label fw-bold">Jabatan</label>
            <div class="mb-3">
            <select name="jabatan" class="form-select">
                <option value="" disabled selected>Pilih Jabatan</option>
                <option value="kasir">kasir</option>
                <option value="sales">sales</option>
            </select>
            <!-- error message untuk stok -->
            @error('jabatan')
            <div class="alert alert-danger mt-2">
            {{ $message }}
            </div>
            @enderror
            </div>



<button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
<button type="reset" class="btn btn-md btn-danger">RESET</button>
<a href="{{ route('karyawan.index') }}" class="btn btn-md btn-warning">KEMBALI</a>
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
