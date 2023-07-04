<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjams = Pinjam::paginate(10);
        $produk = Produk::orderBy('nama_produk')->get();
        return view('admin.peminjaman.index', compact('pinjams', 'produk'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = Produk::orderBy('kategori_id', 'asc')->get();
        return view('admin.peminjaman.create', compact('produks'))->with('no', 1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'produk_id' => 'required',
                'kode_pinjam' => 'required',
                'peminjam' => 'required',
                'jumlah' => 'required|min:1',
                'kondisi_pinjam' => 'required',
                'tgl_pinjam' => 'required'
            ]
        );

        $produk = Produk::findOrFail($request->produk_id);
        if($produk->qty <= 0) {
            toast('Maaf Jumlah '.$produk->nama_produk.' Saat Ini '.$produk->qty, 'error')->autoclose(3000);
            return redirect()->route('peminjaman.create');
        } else if($request->jumlah > 1) {
            return redirect()->route('peminjaman.create')->with('error', 'Maaf Jumlah Produk '.$produk->nama_produk.' Tidak Boleh Lebih Dari 1');
        } else {
            $pjm['produk_id'] = $request->input('produk_id');
            $pjm['kode_pinjam'] = strtoupper($request->input('kode_pinjam'));
            $pjm['peminjam'] = Str::title($request->input('peminjam'));
            $pjm['jumlah'] = $request->input('jumlah');
            $pjm['kondisi_pinjam'] = $request->input('kondisi_pinjam');
            $pjm['tgl_pinjam'] = $request->input('tgl_pinjam');
            $st = "Dipinjam";
            $pjm['status'] = $st;

            Pinjam::create($pjm);

            $produk->qty -= 1;
            $produk->update();

            if (!$request) {
                toast('Peminjaman Gagal Disimpan!', 'error')->autoClose(1500);
                return redirect()->route('peminjaman.create');
            } else {
                toast('Peminjaman Berhasil Disimpan', 'success')->autoClose(1500);
                return redirect()->route('peminjaman.index');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjam $pinjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $produks = Produk::orderBy('nama_produk')->get();
        return view('admin.peminjaman.edit', compact('pinjam', 'produks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pinjam = Pinjam::findOrFail($id);
        try {
            $produk = Produk::findOrFail($request->produk_id);
            $produk->qty += 1;
            $produk->update();
        } catch (Excepion $e) {
            return redirect()->route('peminjaman.edit').$e->message();
        }
        $request->validate(
            [
                'produk_id' => 'required',
                'kode_pinjam' => 'required',
                'peminjam' => 'required',
                'jumlah' => 'required',
                'kondisi_pinjam' => 'required',
                'tgl_pinjam' => 'required',
            ]
        );

        $pro = Produk::findOrFail($request->produk_id);
        $pro->qty -= 1;
        $pro->update();

        $st = "Dipinjam";

        $pinjam->update(
            [
                'produk_id' => $request->input('produk_id'),
                'kode_pinjam' => strtoupper($request->input('kode_pinjam')),
                'peminjam' => Str::title($request->input('peminjam')),
                'jumlah' => $request->input('jumlah'),
                'kondisi_pinjam' => $request->input('kondisi_pinjam'),
                'tgl_pinjam' => $request->input('tgl_pinjam'),
                // 'kondisi_kembali' => $request->input('kondisi_kembali'),
                // 'tgl_kembali' => $request->input('tgl_kembali'),
                'status' => $st,
            ]
        );

        if(!$request) {
            toast('Peminjaman gagal diupdate', 'error')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        } else {
            toast('Peinjaman berhasil diupdate', 'success')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $produk = $pinjam->produk;

        if (($produk->qty - $pinjam->jumlah) < 0) {
            toast('Maaf Stok Anda Nanti Minus', 'error')->autoclose(1500);
            return redirect()->route('stokIn.index');
        } elseif($produk->qty > 0) {
            $produk->qty += $pinjam->jumlah;
            $produk->save();

            $pinjam->delete();

            toast('Peminjaman Berhasil Dihapus', 'success')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        } elseif($produk->qty == 0){
            $produk->qty -= 0;
            $produk->save();

            $pinjam->delete();

            toast('Peminjaman Berhasil Dihapus', 'success')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        }
    }

    public function pengembalianEdit($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $produks = Produk::orderBy('nama_produk')->get();
        return view('admin.pengembalian.edit', compact('pinjam', 'produks'));
    }

    public function pengembalian(Request $request, $id) {
        $pinjam = Pinjam::findOrFail($id);
        $produk = Produk::findOrFail($request->produk_id);
        $request->validate(
            [
                // 'produk_id' => 'required',
                'kode_pinjam' => 'required',
                'peminjam' => 'required',
                'jumlah' => 'required',
                'kondisi_kembali' => 'required',
                'tgl_kembali' => 'required',
            ]
        );


        $st = "Dikembalikan";

        // dd($pinjam);

        $pinjam->update(
            [
                // 'produk_id' => $request->input('produk_id'),
                'kode_pinjam' => strtoupper($request->input('kode_pinjam')),
                'peminjam' => Str::title($request->input('peminjam')),
                'jumlah' => $request->input('jumlah'),
                'kondisi_pinjam' => $request->input('kondisi_pinjam'),
                // 'tgl_pinjam' => $request->input('tgl_pinjam'),
                'kondisi_kembali' => $request->input('kondisi_kembali'),
                'tgl_kembali' => $request->input('tgl_kembali'),
                'status' => $st,
            ]
        );

        $pro = Produk::findOrFail($request->produk_id);
        $pro->qty += 1;
        $pro->update();

        if(!$request) {
            toast('Peminjaman gagal diupdate', 'error')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        } else {
            toast('Peinjaman berhasil diupdate', 'success')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        }
    }

    public function pengembalianIndex()
    {
        $pinjams = Pinjam::paginate(10);
        $produks = Produk::orderBy('nama_produk')->get();
        $produk = Produk::orderBy('nama_produk')->get();
        return view('admin.pengembalian.index', compact('pinjams', 'produk', 'produks'))->with('no', 1);
    }
}
