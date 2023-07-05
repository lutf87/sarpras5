@extends('layouts.master')

@section('tab-title', 'Tambah Barang | Admin')
@section('page-title', 'Tambah Barang')
@section('contents')
    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Barang</h3>
                </div>
                <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <input type="text" id="nama_produk" name="nama_produk"
                                        style="text-transform: capitalize"
                                        class="form-control @error('nama_produk') is-invalid @enderror" autofocus />
                                    @if ($errors->has('nama_produk'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('nama_produk') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="foto_produk" class="form-label">Foto Produk</label>
                                    <input type="file" id="foto_produk" name="foto_produk"
                                        class="form-control @error('foto_produk') is-invalid @enderror" />
                                    @if ($errors->has('foto_produk'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('foto_produk') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama_produk" class="form-label">Gunakan Produk Untuk Dipinjam</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="radio" id="html" name="pinjam" value="ya" checked>
                                            <label for="html" class="me-3">Ya</label>
                                            <input type="radio" id="css" name="pinjam" value="tidak">
                                            <label for="css">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kategori_produk" class="form-label">Kategori Produk</label>
                                    <select class="form-select @error('kategori_produk') is-invalid @enderror"
                                        id="kategori_produk" name="kategori_produk" onchange="">
                                        <option value="" selected>Pilih Kategori</option>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('kategori_produk'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('kategori_produk') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kode_produk" class="form-label">Kode Produk</label>
                                    <input type="text" id="kode_produk" name="kode_produk"
                                        style="text-transform: uppercase" value="sp/pro-"
                                        class="form-control @error('kode_produk') is-invalid @enderror" />
                                    @if ($errors->has('kode_produk'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('kode_produk') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('produk.index') }}" name="kembali" class="btn btn-danger" id="back"><i
                                class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                        <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                            Tambahkan</button>
                    </div>
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
