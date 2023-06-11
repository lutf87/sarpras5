@extends('layouts.master')

@section('tab-title', 'Edit Kategori | Admin')
@section('page-title', 'Edit Kategori')
@section('contents')
    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Kategori</h3>
                </div>
                <form action="{{ route('kategori.update', $kategori->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">
                        <div class="row">
                            <div>
                                <div class="form-group">
                                    <label for="kode_kategori">Kode Kategori</label>
                                    <input type="text" id="kode_kategori" name="kode_kategori"
                                        class="form-control @error('kode_kategori') is-invalid @enderror"
                                        value="{{ old('kode_kategori', $kategori->kode_kategori) }}" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="nama_kategori">Nama Kategori</label>
                                    <input type="text" id="nama_kategori" name="nama_kategori"
                                        class="form-control @error('nama_kategori') is-invalid @enderror"
                                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('kategori.index') }}" name="kembali" class="btn btn-danger" id="back"><i
                                class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                        <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                            Edit</button>
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
