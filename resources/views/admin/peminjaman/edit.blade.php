@extends('layouts.master')

@section('tab-title', 'Edit Peminjaman | Admin')
@section('page-title', 'Edit Peminjaman')
@section('contents')
    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Pinjam</h3>
                </div>
                <form action="{{ route('peminjaman.update', $pinjam->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger alert-block">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="produk_id" class="form-label">Nama Produk</label>
                                    <select name="produk_id" id="produk_id" class="form-select"
                                        @error('produk_id') is-invalid @enderror autofocus>
                                        <option value="">Pilih Produk</option>
                                        @foreach ($produks as $produk)
                                            <option value="{{ $produk->id }}"
                                                @if ($pinjam->produk_id == $produk->id) selected @endif>{{ $produk->nama_produk }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kode_pinjam" class="form-label">Kode Pinjam</label>
                                    <input type="text" id="kode_pinjam" name="kode_pinjam" class="form-control"
                                        @error('kode_pinjam') is-invalid @enderror
                                        style="text-transform: uppercase"
                                        value="{{ old('kode_pinjam', $pinjam->kode_pinjam) }}" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="peminjam" class="form-label">Peminjam</label>
                                    <input type="text" id="peminjam" name="peminjam" class="form-control"
                                        @error('peminjam') is-invalid @enderror
                                        value="{{ old('peminjam', $pinjam->peminjam) }}" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="text" id="jumlah" name="jumlah" class="form-control"
                                        @error('jumlah') is-invalid @enderror
                                        value="{{ old('jumlah', $pinjam->jumlah) }}" readonly/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kondisi_pinjam" class="form-label">Kondisi</label>
                                    <input type="text" id="kondisi_pinjam" name="kondisi_pinjam"
                                        class="form-control @error('kondisi_pinjam') is-invalid @enderror"
                                        value="{{ old('kondisi_pinjam', $pinjam->kondisi_pinjam) }}" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                                    <input type="date" id="tgl_pinjam" name="tgl_pinjam"
                                        class="form-control @error('tgl_pinjam') is-invalid @enderror"
                                        value="{{ old('tgl_oinjam', $pinjam->tgl_pinjam) }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('peminjaman.index') }}" name="kembali" class="btn btn-danger" id="back"><i
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
