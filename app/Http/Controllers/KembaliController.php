<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\Produk;
// use App\Models\Kembali;
use Illuminate\Http\Request;

class KembaliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjams = Pinjam::paginate(10);
        $produks = Produk::orderBy('nama_produk')->get();
        $produk = Produk::orderBy('nama_produk')->get();
        return view('admin.pengembalian.index', compact('pinjams', 'produk', 'produks'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kembali  $kembali
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kembali  $kembali
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $produks = Produk::orderBy('nama_produk')->get();
        return view('admin.pengembalian.edit', compact('pinjam', 'produks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kembali  $kembali
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pinjam = Pinjam::findOrFail($id);
        // try {
        //     $produk = Produk::findOrFail($request->produk_id);
        //     $produk->qty += 1;
        //     $produk->update();
        // } catch (Excepion $e) {
        //     return redirect()->route('peminjaman.edit').$e->message();
        // }
        $request->validate(
            [
                // 'produk_id' => 'required',
                // 'kode_pinjam' => 'required',
                // 'peminjam' => 'required',
                // 'jumlah' => 'required',
                'kondisi_kembali' => 'required',
                'tgl_kembali' => 'required',
            ]
        );

        $pro = Produk::findOrFail($request->produk_id);
        $pro->qty += 1;
        $pro->update();

        $st = "Dikembalikan";

        $pinjam->update(
            [
                // 'produk_id' => $request->input('produk_id'),
                // 'kode_pinjam' => strtoupper($request->input('kode_pinjam')),
                // 'peminjam' => Str::title($request->input('peminjam')),
                // 'jumlah' => $request->input('jumlah'),
                'kondisi_kembali' => $request->input('kondisi_kembali'),
                'tgl_kembali' => $request->input('tgl_kembali'),
                'status' => $st,
            ]
        );

        if(!$request) {
            toast('Peminjaman gagal dikembalikan', 'error')->autoClose(1500);
            return redirect()->route('pengembalian.index');
        } else {
            toast('Peinjaman berhasil dikembalikan', 'success')->autoClose(1500);
            return redirect()->route('pengembalian.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kembali  $kembali
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
