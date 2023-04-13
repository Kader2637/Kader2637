@extends('penjualan.master')
@section('judul')
Edit penjualan - Toko
@endsection
@section('konten')

<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded">
            <div class="card-body">
                <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if(session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Barang</label>
                        <select class="form-select @error('nama') is-invalid @enderror" name="nama"  readonly>
                            @foreach($barangs as $barang)
                            <option value="{{ $barang->nama }}" {{ ($penjualan->nama == $barang->nama) ? 'selected' : '' }}>
                                {{ $barang->nama }}
                            </option>
                            @endforeach
                        </select>

                        @error('nama')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Harga Barang</label>
                        <select class="form-control @error('harga') is-invalid @enderror" name="harga" readonly>
                            @foreach($barangs as $barang)
                            <option value="{{ $barang->jual }}" {{ ($penjualan->jual == $barang->jual) ? 'selected' : '' }}>
                                {{ $barang->jual }}
                            </option>
                            @endforeach
                        </select>

                        @error('harga')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Stok</label>
                        <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok"
                            value="{{ old('stok', $penjualan->stok) }}" placeholder="Masukkan stok penjualan">
                        <!-- error message untuk stok -->
                        @error('stok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-md btn-warning">KEMBALI</a>
                </form>
                @if(Session::has('success'))
                <div class="alert alert-success mt-3">
                    {{ Session::get('success') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
