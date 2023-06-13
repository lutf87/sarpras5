<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\StokInController;
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

Route::get('dashboard', [DashboardController::class, 'index']);


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
    // Route::get('stok', [StokInController::class, 'stok'])->name('stok.stok');
    // Route::prefix('stokIn')->group(function () {
    //     // Route::get('/', [StokInController::class, 'index'])->name('stokIn.index');
    // });
});
