@extends('customer.master')
@section('judul')
Tambah customer - Toko
@endsection
@section('konten')
<div class="row">
<div class="col-md-12">
<div class="card border-0 shadow rounded">
<div class="card-body">
<form action="{{ route('customer.store') }}" method="POST"
enctype="multipart/form-data">
@csrf
<div class="mb-3">
<label class="form-label fw-bold">Nama Anggota</label>
<input type="text" class="form-control
@error('nama') is-invalid @enderror" name="nama"
value="{{ old('nama') }}"
placeholder="Masukkan Nama">
<!-- error message untuk title -->
@error('nama')
<div class="alert alert-danger mt-2">
Nama sudah di gunakan
</div>
@enderror
</div>


<div class="mb-3">
    <label class="form-label fw-bold">Jenis Kelamin</label><br>
    <input type="radio" value="laki-laki" name="jenis_kelamin">laki-laki
    <input type="radio" value="perempuan" name="jenis_kelamin">perempuan
    <!-- error message untuk satuan -->
    @error('jenis_kelamin')
    <div class="alert alert-danger mt-2">
    {{ $message }}
    </div>
    @enderror
    </div>

<div class="mb-3">
<label class="form-label fw-bold">Jabatan</label>
<div class="mb-3">
<select name="jabatan" class="form-select">
    <option value="" disabled selected>Pilih Jabatan</option>
    <option value="admin">admin</option>
    <option value="petugas">petugas</option>
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
<a href="{{ route('customer.index') }}" class="btn btn-md btn-warning">KEMBALI</a>
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
