<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index()
    {

        $produk = DB::table('produks')->count();
        $stok = Produk::sum('qty');
        $pro_pjm = Produk::whereIn('pinjam', ['ya'])->count();
        $pro_tk = Produk::whereIn('pinjam', ['tidak'])->count();
        $pro_tdk = Produk::whereIn('pinjam', ['ya'])->sum('qty');
        $pro_tk_st = Produk::whereIn('pinjam', ['tidak'])->sum('qty');
        return view('admin.dashboard', compact('produk', 'stok', 'pro_pjm', 'pro_tdk', 'pro_tk', 'pro_tk_st'));
    }
}
