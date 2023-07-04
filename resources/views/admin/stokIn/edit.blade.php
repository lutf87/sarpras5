@extends('layouts.master')

@section('tab-title', 'Edit Stok | Admin')
@section('page-title', 'Edit Stok')
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
                                    <label for="produk_id" class="form-label">Nama Produk</label>
                                    <select class="form-select @error('produk_id') is-invalid @enderror" id="produk_id"
                                        name="produk_id" autofocus>
                                        <option value="">Pilih Nama Produk</option>
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}"
                                                @if ($stokIn->produk_id == $produk->id) selected @endif>
                                                {{ $produk->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="harga_beli" class="form-label">Harga Beli Produk</label>
                                    <input type="text" id="harga_beli" name="harga_beli"
                                        class="uang form-control @error('harga_beli') is-invalid @enderror"
                                        value="{{ old('harga_beli', $stokIn->harga_beli) }}"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_beli" class="form-label">Tanggal Beli</label>
                                    <input type="date" id="tgl_beli" name="tgl_beli"
                                        class="form-control @error('tgl_beli') is-invalid @enderror"
                                        value="{{ old('tgl_beli', $stokIn->tgl_beli) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="qty" class="form-label">Jumlah Produk Masuk</label>
                                    <input type="number" id="qty" name="qty"
                                        class="form-control @error('qty') is-invalid @enderror"
                                        value="{{ old('qty', $stokIn->qty) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="penempatan" class="form-label">Penempatan</label>
                                    <select name="penempatan" id="penempatan"
                                        class="form-select @error('penempatan') is-invalid @enderror">
                                        <option value="">Penempatan Produk</option>
                                        @foreach ($tempats as $tempat)
                                            <option value="{{ $tempat->id }}"
                                                @if ($stokIn->tempat_id == $tempat->id) selected @endif>
                                                {{ $tempat->nama_tempat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{ route('stokIn.index', $produk->id) }}" name="kembali" class="btn btn-danger"
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
