@extends('layouts.master')

@section('tab-title', 'Detail Produk | Admin')
@section('page-title', 'Detail Produk')
@section('contents')
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Detail Produk</h3>
            </div>
            <div class="card-body">
                <div class="row no-gutters ml-2 mb-2 mr-2">
                    <div class="col-md-4">
                        <img src="{{ Storage::url('produk/'. $produk->gambar) }}" class="card-img img-thumbnails"
                            style="width: 300px">
                    </div>
                    <div class="col-md-1 mb-4"></div>
                    <div class="col-md-7">
                        <h5 class="card-title card-text mb-4">Nama : #</h5>
                        <h5 class="card-title card-text mb-4">NIP : #</h5>
                        {{-- <h5 class="card-title card-text mb-4">Produk Mapel : {{ $Produk->mapels->nama_mapel }}</h5> --}}
                        <h5 class="card-title card-text mb-4">Jenis Kelamin : Laki-laki</h5>
                        <h5 class="card-title card-text mb-4">Jenis Kelamin : Perempuan</h5>
                        {{-- @if ()
                        @else
                        @endif --}}
                        <h5 class="card-title card-text mb-4">Tempat Lahir : #</h5>
                        <h5 class="card-title card-text mb-4">Tanggal Lahir :</h5>
                        {{-- {{ date('l, d F Y', strtotime()) }} --}}
                        <h5 class="card-title card-text mb-4">Alamat : #</h5>

                    </div>
                </div>
                <div class="card-footer">
                    <a href="#" name="kembali" class="btn btn-default" id="back"><i
                            class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                </div>
            </div>
        </div>
    </div>
@endsection
