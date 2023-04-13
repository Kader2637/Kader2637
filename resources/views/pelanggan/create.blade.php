@extends('pelanggan.master')
@section('judul')
Tambah pelanggan - Toko
@endsection
@section('konten')
<div class="row">
<div class="col-md-12">
<div class="card border-0 shadow rounded">
<div class="card-body">
<form action="{{ route('pelanggan.store') }}" method="POST"
enctype="multipart/form-data">
@csrf

<div class="mb-3">
<label class="form-label fw-bold">Nama pelanggan</label>
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
    <label class="form-label fw-bold">Jenis Kelamin</label><br>
    <input type="radio" value="laki-laki" name="jk">laki-laki
    <input type="radio" value="perempuan" name="jk">perempuan
    <!-- error message untuk satuan -->
    @error('jk')
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




<button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
<button type="reset" class="btn btn-md btn-danger">RESET</button>
<a href="{{ route('pelanggan.index') }}" class="btn btn-md btn-warning">KEMBALI</a>
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

{{--

<div class="mb-3">

    <label class="form-label fw-bold" for="alamat">Alamat</label>
    <textarea id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan alamat pelanggan">{{ old('alamat', $pelanggan->alamat) }}</textarea>
    <!-- error message untuk title -->
    @error('alamat')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
</div>  --}}
