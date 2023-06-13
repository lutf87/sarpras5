@extends('layouts.master')

@section('tab-title', 'Detail Produk | Admin')
@section('page-title', 'Detail Produk')
@section('contents')
<div class="row">
    <div class="col-md-5">
        <div class="card border-0 shadow rounded">
            <div class="card-header">
                <h3 class="card-title">Edit Data Stok</h3>
            </div>
            <form action="{{ route('stokIn.update', $stokIn->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <select class="form-select @error('nama_produk') is-invalid @enderror"
                                    id="nama_produk" name="nama_produk" onchange="">
                                    <option value="">Pilih nama</option>
                                    @foreach ($stokIns as $stok)
                                        <option value="{{ $stok->id }}"
                                            @if ($produk->nama_id == $nama->id) selected @endif>
                                            {{ $stok-> }}</option>
                                    @endforeach
                                </select>
                                <input type="text" id="nama_produk" name="nama_produk"
                                    class="form-control @error('nama_produk') is-invalid @enderror" autofocus
                                    value="{{ old('nama_produk', $stokIn->produk->nama_produk) }}" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="kode_produk" class="form-label">Kode Produk</label>
                                <input type="text" id="kode_produk" name="kode_produk"
                                    class="form-control @error('kode_produk') is-invalid @enderror"
                                    value="{{ old('kode_produk', $produk->kode_produk) }}" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama_produk" class="form-label">nama Produk</label>
                                <select class="form-select @error('nama_produk') is-invalid @enderror"
                                    id="nama_produk" name="nama_produk" onchange="">
                                    <option value="" selected>Pilih nama</option>
                                    @foreach ($namas as $nama)
                                        <option value="{{ $nama->id }}"
                                            @if ($produk->nama_id == $nama->id) selected @endif>
                                            {{ $nama->nama_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="foto_produk" class="form-label">Foto Produk</label>
                                <input type="file" id="foto_produk" name="foto_produk"
                                    class="form-control @error('foto_produk') is-invalid @enderror"
                                    value="{{ old('gambar', $produk->foto_produk) }}" />
                                @error('foto_produk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="{{ route('produk.show', $produk->id) }}" name="kembali" class="btn btn-danger"
                        id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                    <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                        Simpan</button>
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
