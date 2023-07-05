@extends('layouts.master')

@section('tab-title', 'Tambah Kategori | Admin')
@section('page-title', 'Tambah Kategori')
@section('contents')
    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Kategori</h3>
                </div>
                <form action="{{ route('kategori.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="card-body">
                        <div class="row">
                            <div>
                                <div class="form-group">
                                    <label for="nama_kategori">Nama Kategori</label>
                                    <input type="text" id="nama_kategori" name="nama_kategori"
                                        style="text-transform: capitalize"
                                        class="form-control @error('kode_kategori') is-invalid @enderror" autofocus/>
                                    @if ($errors->has('nama_kategori'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('nama_kategori') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="kode_kategori">Kode Kategori</label>
                                    <input type="text" id="kode_kategori" name="kode_kategori"
                                        style="text-transform: uppercase" value="sp/kat-"
                                        class="form-control @error('kode_kategori') is-invalid @enderror" />
                                    @if ($errors->has('kode_kategori'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="text-danger mt-1">{{ $errors->first('kode_kategori') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('kategori.index') }}" name="kembali" class="btn btn-danger" id="back"><i
                                class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                        <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                            Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
