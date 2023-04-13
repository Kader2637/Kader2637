@extends('karyawan.master')
@section('judul')
Edit karyawan - Toko
@endsection
@section('konten')
<div class="row">
<div class="col-md-12">
<div class="card border-0 shadow rounded">
<div class="card-body">
    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST"
        enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="mb-3">
<label class="form-label fw-bold">Nama karyawan</label>
<input type="text" class="form-control
@error('nama') is-invalid @enderror" name="nama"
value="{{ old('nama', $karyawan->nama) }}"
placeholder="Masukkan nama karyawan">
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
    value="{{ old('alamat', $karyawan->alamat) }}"
    placeholder="Masukkan alamat karyawan">
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
        @error('no') is-invalid @enderror" name="no"
        value="{{ old('no', $karyawan->no) }}"
        placeholder="Masukkan no karyawan">
        <!-- error message untuk title -->
        @error('no')
        <div class="alert alert-danger mt-2">
        {{ $message }}
        </div>
        @enderror
        </div>

<div class="mb-3">
    <label class="form-label fw-bold">Jabatan</label>
    <div class="mb-3">
        <select name="jabatan" class="form-select">
            <option value="kasir" {{ old('kasir', $karyawan->jabatan) == 'kasir' ? 'selected' : '' }}>kasir</option>
            <option value="sales" {{ old('sales', $karyawan->jabatan) == 'sales' ? 'selected' : '' }}>sales</option>
        </select>
        <!-- error message untuk satuan -->
        @error('jabatan')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
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
