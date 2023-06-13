<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Satuan;
use App\Models\StokIn;
use App\Models\Tempat;
use Illuminate\Http\Request;

class StokInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stokIns = StokIn::paginate(10);
        $produk = Produk::orderBy('nama_produk')->get();
        $tempat = Tempat::orderBy('nama_tempat')->get();
        $satuan = Satuan::orderBy('nama_satuan')->get();
        return view('admin.stokIn.index', compact('produk', 'stokIns', 'tempat', 'satuan'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = Produk::orderBy('id')->get();
        $tempats = Tempat::orderBy('nama_tempat')->get();
        $satuans = Satuan::orderBy('nama_satuan')->get();
        return view('admin.stokIn.create', compact('produks', 'tempats', 'satuans'));
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
                'nama_produk' => 'required',
                'nama_satuan' => 'required',
                'nama_tempat' =>'required'
            ],
            [
                'nama_produk.required' => 'Produk harus diisi',
                'nama_satuan.required' => 'Satuan harus diisi',
                'nama_tempat.required' => 'Penempatan harus diisi'
            ]
        );

        if($request->harga_beli)
        {
            $in_hrg = $request->input('harga_beli');  // menangkap req input harga yang berupa string
            $hrg_str = preg_replace("/[^0-9]/", "", $in_hrg);  // Menghapus karakter non-angka(string)
            $hrg_int = intval($hrg_str); // mendapatkan nilai integer
        }

        $stokIn['produk_id'] = $request->input('nama_produk');
        $stokIn['satuan_id'] = $request->input('nama_satuan');
        $stokIn['tempat_id'] = $request->input('nama_tempat');
        $stokIn['harga_beli'] = $hrg_int;
        $stokIn['tgl_beli'] = $request->input('tgl_beli');
        $stokIn['jml_produk'] = $request->input('jml_produk');
        StokIn::create($stokIn);

        if (!$request) {
            toast('Stok Masuk gagal ditambahkan','error')->autoClose(1500);
            return redirect()->route('stokIn.create');
        } else {
            toast('Stok Masuk Berhasil ditambah','success')->autoClose(1500);
            return redirect()->route('stokIn.index');
        }

        // return view('admin.stokin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StokIn  $stokIn
     * @return \Illuminate\Http\Response
     */
    public function show(StokIn $stokIn)
    {
        // return view('')
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StokIn  $stokIn
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stokIn = StokIn::findOrFail($id);
        $produks = Produk::orderBy('nama_produk')->get();
        return view('admin.stokIn.edit', compact('stokIns', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StokIn  $stokIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StokIn $stokIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StokIn  $stokIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(StokIn $stokIn)
    {
        //
    }

    public function stok() {
        $jml = StokIn::orderBy('jml_produk')->get();
        dd($jml);
    }
}
