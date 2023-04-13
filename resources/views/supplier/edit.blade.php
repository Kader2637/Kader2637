@extends('supplier.master')
@section('judul')
    Edit supplier - Toko
@endsection
@section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Supplier</label>
                            <input type="text" class="form-control
                                        @error('nama') is-invalid @enderror" name="nama"
                                value="{{ old('nama', $supplier->nama) }}" placeholder="Masukkan nama supplier">
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
                                        @error('alamat') is-invalid @enderror"
                                name="alamat" value="{{ old('alamat', $supplier->alamat) }}"
                                placeholder="Masukkan alamat supplier">
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
                                     @error('no') is-invalid @enderror"
                                name="no" value="{{ old('no', $supplier->no) }}" placeholder="Masukkan no supplier">
                            <!-- error message untuk title -->
                            @error('no')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Jenis kelamin</label><br>
                                <input type="radio" value="laki-laki" name="jk"
                                    {{ old('admin', $supplier->jk) == 'laki-laki' ? 'checked' : '' }}>
                                laki-laki
                                <input type="radio" value="perempuan" name="jk"
                                    {{ old('petugas', $supplier->jk) == 'perempuan' ? 'checked' : '' }}>
                                perempuan
                                <!-- error message untuk jabatan -->
                                @error('jk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        <button type="reset" class="btn btn-md btn-danger">RESET</button>
                        <a href="{{ route('supplier.index') }}" class="btn btn-md btn-warning">KEMBALI</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
