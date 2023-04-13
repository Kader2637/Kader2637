@extends('customer.master')
@section('judul')
Edit customer - Toko
@endsection
@section('konten')
<div class="row">
<div class="col-md-12">
<div class="card border-0 shadow rounded">
<div class="card-body">
    <form action="{{ route('customer.update', $customer->id) }}" method="POST"
        enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="mb-3">
<label class="form-label fw-bold">Nama Petugas</label>
<input type="text" class="form-control
@error('nama') is-invalid @enderror" name="nama"
value="{{ old('nama', $customer->nama) }}"
placeholder="Masukkan nama customer">
<!-- error message untuk title -->
@error('nama')
<div class="alert alert-danger mt-2">
Nama telah digunakan !
</div>
@enderror
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Jenis kelamin</label><br>
    <input type="radio" value="laki-laki" name="jenis_kelamin" {{ old('admin', $customer->jenis_kelamin) == 'laki-laki' ? 'checked' : '' }}> laki-laki
    <input type="radio" value="perempuan" name="jenis_kelamin" {{ old('petugas', $customer->jenis_kelamin) == 'perempuan' ? 'checked' : '' }}> perempuan
    <!-- error message untuk jabatan -->
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
            <option value="admin" {{ old('admin', $customer->jabatan) == 'admin' ? 'selected' : '' }}>admin</option>
            <option value="petugas" {{ old('petugas', $customer->jabatan) == 'petugas' ? 'selected' : '' }}>petugas</option>
        </select>
        <!-- error message untuk satuan -->
        @error('jabatan')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
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
