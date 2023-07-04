<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\StokInController;
use App\Http\Controllers\StokOutController;
use App\Http\Controllers\TempatController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\KembaliController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


Route::prefix('admin')->group(function () {
    // kategori
    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('tambah', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');
        Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
        Route::get('edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::patch('/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    });

    // produk
    Route::prefix('produk')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
        Route::get('tambah', [ProdukController::class, 'create'])->name('produk.create');
        Route::post('/', [ProdukController::class, 'store'])->name('produk.store');
        Route::get('detail/{id}', [ProdukController::class, 'show'])->name('produk.show');
        Route::get('edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
        Route::post('update/{id}', [ProdukController::class, 'update'])->name('produk.update');
        Route::delete('/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    });

    // stok masuk

    Route::resource('stokIn', StokInController::class);
    Route::resource('stokOut', StokOutController::class);
    Route::resource('stok', StokController::class);
    Route::resource('tempat', TempatController::class);
    Route::resource('peminjaman', PinjamController::class);
    // Route::resource('pengembalian', KembaliController::class);
    Route::prefix('pengembalian')->group(function () {
        Route::get('/', [PinjamController::class, 'pengembalianIndex'])->name('pengembalian.index');
        Route::get('edit/{id}', [PinjamController::class, 'pengembalianEdit'])->name('pengembalian.edit');
        Route::put('/{id}', [PinjamController::class, 'pengembalian'])->name('pengembalian.update');
    });
});
