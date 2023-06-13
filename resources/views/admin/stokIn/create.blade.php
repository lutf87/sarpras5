@extends('layouts.master')

@section('tab-title', 'Tambah Stok | Admin')
@section('page-title', 'Tambah Stok')
@section('contents')
    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Produk</h3>
                </div>
                <form action="{{ route('stokIn.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('POST') --}}

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                {{-- <div class="form-group mb-3">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <input type="text" id="nama_produk" name="nama_produk"
                                    class="form-control @error('nama_produk') is-invalid @enderror" autofocus />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kode_produk" class="form-label">Kode Produk</label>
                                    <input type="text" id="kode_produk" name="kode_produk"
                                    class="form-control @error('kode_produk') is-invalid @enderror" />
                                </div> --}}
                                <div class="form-goup mb-3">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <select class="form-select @error('nama_produk') is-invalid @enderror" id="nama_produk"
                                        name="nama_produk" onchange="">
                                        <option value="" selected>Pilih Produk</option>
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="form-group mb-3">
                                    <label for="kategori_produk" class="form-label">Kategori Produk</label>
                                    <select class="form-select @error('kategori_produk') is-invalid @enderror"
                                        id="kategori_produk" name="kategori_produk" onchange="">
                                        <option value="" selected>Pilih Kategori</option>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                {{-- <div class="form-group mb-3">
                                    <label for="foto_produk" class="form-label">Foto Produk</label>
                                    <input type="file" id="foto_produk" name="foto_produk"
                                        class="form-control @error('foto_produk') is-invalid @enderror" />
                                    @error('foto_produk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> --}}
                                <div class="form-group mb-3">
                                    <label for="harga_beli" class="form-label">Harga Beli Produk</label>
                                    <input type="text" id="harga_beli" name="harga_beli"
                                        class="uang form-control @error('harga_beli') is-invalid @enderror" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_beli" class="form-label">Tanggal Beli Produk</label>
                                    <input type="date" id="tgl_beli" name="tgl_beli"
                                        class="form-control @error('tgl_beli') is-invalid @enderror" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jml_produk" class="form-label">Jumlah Produk</label>
                                    <input type="number" id="jml_produk" name="jml_produk"
                                        class="form-control @error('jml_produk') is-invalid @enderror" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_satuan" class="form-label">Satuan Produk Produk</label>
                                    <select class="form-select @error('nama_satuan') is-invalid @enderror"
                                        name="nama_satuan" id="nama_satuan">
                                        <option value="">Pilih Satuan Produk</option>
                                        @foreach ($satuans as $satuan)
                                            <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_tempat" class="form-label">Penepatan Produk</label>
                                    <select name="nama_tempat" id="nama_tempat" class="form-select">
                                        <option value="">Pilih Penematan</option>
                                        @foreach ($tempats as $tempat)
                                            <option value="{{ $tempat->id }}">{{ $tempat->nama_tempat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('stokIn.index') }}" name="kembali" class="btn btn-danger" id="back"><i
                                class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                        <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                            Tambahkan</button>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        config = {
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
        }
        flatpickr("input[type=datetime-local]");
    </script>
@endpush
