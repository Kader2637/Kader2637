@extends('pembelian.master')
@section('judul')
    Tambah pembelian - Toko
@endsection
@section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Supplier</label>
                            <div class="mb-3">
                                <select name="nama" id="nama" class="form-select">
                                    @if ($suppliers->isEmpty())
                                        <option value="">Data kosong</option>
                                    @else
                                        <option value="" selected readonly>Pilih Nama Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->nama }}">{{ $supplier->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <!-- error message untuk title -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        Data tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                        </div>



                        {{-- <div class="mb-3">
                        <label class="form-label fw-bold">Nama Supplier
                        </label>
                        <div class="mb-3">
                            <select name="nama" id="nama" class="form-select">
                                <option></option>
                                @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->nama }}">{{ $supplier->nama }}</option>
                                @endforeach
                            </select>
                            <!-- error message untuk title -->
                            @error('nama')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        --}}

                        <div class="mb-3">
                            <label class="form-label fw-bold">Barang</label>
                            <div class="mb-3">
                                <select name="produk" id="produk" class="form-select">
                                    @if ($barangs->isEmpty())
                                        <option value="" readonly>Data kosong</option>
                                    @else
                                        <option value="" selected>Pilih Barang</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->nama }}">{{ $barang->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <!-- error message untuk title -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        Data tidak boleh kosong
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="mb-3">
                            <label class="form-label fw-bold">Barang
                            </label>
                            <div class="mb-3">
                                <select name="produk" id="produk" class="form-select">
                                    <option> </option>
                                    @foreach ($barangs as $barang)
                                    <option value="{{ $barang->nama }}">{{ $barang->nama }}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk title -->
                                @error('nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <input type="date" name="tgl" id="" class="form-control"
                                value="{{ date('d-m-Y') }}">
                            <!-- error message untuk title -->
                            @error('tgl')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Stok</label>
                            <input type="text" class="form-control
        @error('stok') is-invalid @enderror"
                                name="stok" value="{{ old('stok') }}" placeholder="Masukkan stok">
                            <!-- error message untuk title -->
                            @error('stok')
                                <div class="alert alert-danger mt-2">
                                    Data input tidak valid
                                </div>
                            @enderror
                        </div>




                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        <button type="reset" class="btn btn-md btn-danger">RESET</button>
                        <a href="{{ route('pembelian.index') }}" class="btn btn-md btn-warning">KEMBALI</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('skrip')
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');

        // Menambahkan event listener pada select nama produk
        document.getElementById('nama').addEventListener('change', function() {
            // Mendapatkan harga dari barang yang dipilih
            var barang = @json($barangs);
            var harga = 0;
            for (var i = 0; i < barang.length; i++) {
                if (barang[i].nama == this.value) {
                    harga = barang[i].jual;
                    break;
                }
            }
            // Mengisi value pada select harga
            document.getElementById('harga').innerHTML = '<option value="' + harga + '">' + harga + '</option>';
        });
    </script>
@endsection
