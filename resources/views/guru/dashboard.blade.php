@extends('layouts.master')

@section('tab-title', 'Dashboard | Admin')
@section('page-title', 'Dashboard')
@section('contents')
<div class="row">

    <!-- Total Keseluruhan Produk -->
    <div class="col-md-3">
        <!-- Total Produk -->
        <div class="col">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Produk Milik Guru<h3>{{ $produk }}</h3></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

        <!-- Total Stok Produk -->
        <div class="col">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Stok Produk <h3>{{ $stok }}</h3></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>
    </div>

    <!-- Total Produk Pinjam -->
    <div class="col-md-3">

        <!-- Total Produk Pinjam -->
        <div class="col">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Total Produk Pinjam<h3>{{ $pro_pjm }}</h3></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

        <!-- Total Stok Produk Pinjam -->
        <div class="col">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Total Stok Produk Pinjam <h3>{{ $pro_pjm_total }}</h3></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>
    </div>

    <!-- Total Produk Tak Pinjam -->
    <div class="col-md-3">

        <!-- Total Produk Tak Pinjam -->
        <div class="col">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Total Produk Tak Pinjam <h3>{{ $pro_hbs }}</h3></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>

        <!-- Total Stok Produk Tak Pinjam -->
        <div class="col">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Total Stok Produk Tak Pinjam <h3>{{ $pro_hbs_total }}</h3></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

