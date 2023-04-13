
@extends('penjualan.master')

@section('judul')
Tambah penjualan - Toko
@endsection

@section('konten')
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded">
            <div class="card-body">
                <form action="{{ route('penjualan.store') }}" method="POST" enctype="multipart/form-data">
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

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Barang</label>
                            <div class="mb-3">
                                <select name="nama" id="nama" class="form-select">
                                    @if ($barangs->isEmpty())
                                        <option value="">Data kosong</option>
                                    @else
                                        <option value="" disabled selected>Pilih Barang</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->nama }}">{{ $barang->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <!-- error message untuk title -->
                                @error('nama')
                                <div class="alert alert-danger mt-2">
                                    Harap Pilih Barang
                                </div>
                                @enderror
                            </div>
                        </div>
{{--

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Barang</label>
                            <div class="mb-3">
                                <select name="nama" id="nama" class="form-select">
                                    <option disabled selected>Pilih Barang</option>
                                    @foreach($barangs as $barang)
                                    <option value="{{$barang->nama}}">{{$barang->nama}}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk title -->
                                @error('nama')
                                <div class="alert alert-danger mt-2">
                                    Harap di isi
                                </div>
                                @enderror
                            </div>  --}}

                            <div class="mb-3">
                                <label class="form-label fw-bold">Harga</label>
                                <div class="mb-3">
                                    <select name="harga" id="harga" class="form-control" readonly>

                                    </select>
                                    <!-- error message untuk title -->
                                    @error('nama')
                                    {{--  <div class="alert alert-danger mt-2">
                                        Harap di isi
                                    </div>  --}}
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Stok</label>
                                    <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok') }}" placeholder="Masukkan stok barang">
                                    <!-- error message untuk stok barang -->
                                    @error('stok')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                                <button type="reset" class="btn btn-md btn-danger">RESET</button>
                                <a href="{{ route('penjualan.index') }}" class="btn btn-md btn-warning">KEMBALI</a>
                            </div>
                        </div>
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

// Menambahkan event listener pada select nama produk
document.getElementById('nama').addEventListener('change', function() {
    // Mendapatkan harga dari barang yang dipilih
    var barang = @json($barangs);
    var harga = 0;
    for(var i=0; i<barang.length; i++) {
        if(barang[i].nama == this.value) {
            harga = barang[i].jual;
            break;
        }
    }
    // Mengisi value pada select harga
    document.getElementById('harga').innerHTML = '<option value="'+harga+'">'+harga+'</option>';
});
</script>
@endsection
