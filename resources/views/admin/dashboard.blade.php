@extends('layouts.master')

@section('tab-title', 'Dashboard | Admin')
@section('page-title', 'Dashboard')
@section('contents')
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Total Produk <h3>{{ $produk }}</h3></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                {{-- <a class="small text-white stretched-link" href="#">View Details</a> --}}
                {{-- <div class="small text-white"><i class="fas fa-angle-right"></i></div> --}}
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white mb-4">
            <div class="card-body">Total Stok Produk <h3>{{ $stok }}</h3></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                {{-- <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div> --}}
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">Total Produk Pinjam<h3>{{ $pro_pjm }}</h3></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                {{-- <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div> --}}
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Total Stok Produk Pinjam <h3>{{ $pro_tdk }}</h3></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                {{-- <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div> --}}
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Total Produk Tak Pinjam<h3>{{ $pro_tk }}</h3></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                {{-- <a class="small text-white stretched-link" href="#">View Details</a> --}}
                {{-- <div class="small text-white"><i class="fas fa-angle-right"></i></div> --}}
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white mb-4">
            <div class="card-body">Total Stok Produk Tak Pinjam <h3>{{ $pro_tk_st }}</h3></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                {{-- <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div> --}}
            </div>
        </div>
    </div>
</div>
@endsection

