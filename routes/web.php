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
    
    // produk
    Route::resource('produk', ProdukController::class);

    // stok masuk
    Route::resource('stokIn', StokInController::class);
    Route::prefix('stokIn')->group(function () {
        Route::get('/export-excel', [StokInController::class, 'export'])->name('stokIn.export');
        Route::get('/export-total', [StokInController::class, 'total'])->name('stokAll.export');
    });

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
