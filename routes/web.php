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
use App\Http\Controllers\LoginController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'autenthicating'])->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');



Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // kategori
    Route::resource('kategori', KategoriController::class);

    // stok masuk
    Route::prefix('stokIn')->group(function () {
        Route::get('/export-excel', [StokInController::class, 'exportExcel'])->name('stokIn.export');
        Route::get('/export-pdf', [StokInController::class, 'exportPdf'])->name('stokIn.exportPdf');
    });
    Route::resource('stokIn', StokInController::class);

    // stok keluar
    Route::prefix('stokOut')->group(function () {
        Route::get('/export-excel', [StokOutController::class, 'exportExcel'])->name('stokOut.export');
        Route::get('/export-pdf', [StokOutController::class, 'exportPdf'])->name('stokOut.exportPdf');
    });
    Route::resource('stokOut', StokOutController::class);

    // stok total
    Route::prefix('stok')->group(function () {
        Route::get('/export-excel', [StokController::class, 'exportExcel'])->name('stok.export');
        Route::get('/export-pdf', [StokController::class, 'exportPdf'])->name('stok.exportPdf');
    });
    Route::resource('stok', StokController::class);

    // produk
    Route::prefix('produk')->group(function () {
        Route::get('/export-excel', [ProdukController::class, 'exportExcel'])->name('produk.export');
        Route::get('/export-pdf', [ProdukController::class, 'exportPdf'])->name('produk.exportPdf');
    });
    Route::resource('produk', ProdukController::class);

    Route::resource('tempat', TempatController::class);
    Route::resource('peminjaman', PinjamController::class);
    // Route::resource('pengembalian', KembaliController::class);
    Route::prefix('pengembalian')->group(function () {
        Route::get('/', [PinjamController::class, 'pengembalianIndex'])->name('pengembalian.index');
        Route::get('edit/{id}', [PinjamController::class, 'pengembalianEdit'])->name('pengembalian.edit');
        Route::put('/{id}', [PinjamController::class, 'pengembalian'])->name('pengembalian.update');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
