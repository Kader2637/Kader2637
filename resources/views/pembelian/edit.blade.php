@extends('pembelian.master')
@section('judul')
    Edit pembelian - Toko
@endsection
@section('konten')

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Supplier</label>
                            <select class="form-select @error('nama') is-invalid @enderror" name="nama">
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->nama }}"
                                        {{ $pembelian->nama == $supplier->nama ? 'selected' : '' }}>
                                        {{ $supplier->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- error message untuk barang -->
                            @error('nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold"> Barang</label>
                            <select class="form-control @error('produk') is-invalid @enderror" name="produk">
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->nama }}"
                                        {{ $pembelian->nama == $barang->nama ? 'selected' : '' }}>
                                        {{ $barang->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- error message untuk produk -->
                            @error('produk')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <input type="date" name="tgl" id="" class="form-control"
                                value="{{ date('Y-m-d', strtotime($pembelian->tgl)) }}">
                            @error('tgl')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Stok</label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok"
                                value="{{ old('stok', $pembelian->stok) }}" placeholder="Masukkan stok pembelian">
                            <!-- error message untuk stok -->
                            @error('stok')
                                <div class="alert alert-danger mt-2">
                                    @if ($message == 'validation.min.numeric')
                                        Stok tidak boleh kurang dari 1.
                                    @else
                                        {{ $message }}
                                    @endif
                                </div>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        <button type="reset" class="btn btn-md btn-danger">RESET</button>
                        <a href="{{ route('pembelian.index') }}" class="btn btn-md btn-warning">KEMBALI</a>
                    </form>
                    @if (Session::has('success'))
                        <div class="alert alert-success mt-3">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
