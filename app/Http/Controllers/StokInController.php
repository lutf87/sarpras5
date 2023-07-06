<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Satuan;
use App\Models\StokIn;
use App\Models\Tempat;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockExport;
use PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('admin.stokIn.index', compact('produk', 'stokIns', 'tempat'))->with('no', 1);
        // dd($hrg);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = Produk::orderBy('kategori_id', 'asc')->get();
        $tempats = Tempat::orderBy('id')->get();
        return view('admin.stokIn.create', compact('produks', 'tempats'))->with('no', 1);
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
                'nama_tempat' =>'required',
                'qty' => 'required',
                // 'harga_beli' => 'required'
            ],
            [
                'produk_id.required' => 'Produk harus diisi',
                'qty.required' => 'Jumlah Produk harus diisi',
                'nama_tempat.required' => 'Penempatan harus diisi',
                // 'harga_beli.required' => 'Harga Beli harus diisi'
            ]
        );

        if($request->harga_beli)
        {
            $in_hrg = $request->input('harga_beli');  // menangkap req input harga yang berupa string
            $hrg_str = preg_replace("/[^0-9]/", "", $in_hrg);  // Menghapus karakter non-angka(string)
            $hrg_int = intval($hrg_str); // mendapatkan nilai integer
        }

        $stokIn['produk_id'] = $request->input('produk_id');
        $stokIn['tempat_id'] = $request->input('nama_tempat');
        $stokIn['merk'] = Str::title($request->input('merk'));
        $stokIn['harga_beli'] = $hrg_int;
        $stokIn['tgl_beli'] = $request->input('tgl_beli');
        $stokIn['qty'] = $request->input('qty');
        StokIn::create($stokIn);
        // dd($stokIn);

        $produk = Produk::findOrFail($request->produk_id);
        $produk->qty += $request->qty;
        $produk->save();

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
        $tempats = Tempat::orderBy('nama_tempat')->get();
        return view('admin.stokIn.edit', compact('stokIn', 'produks', 'tempats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StokIn  $stokIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stokIn = StokIn::findOrFail($id);
        try {
            $produk = Produk::findOrFail($request->produk_id);
            $produk->qty -= $stokIn->qty;
            $produk->update();
        } catch (Exception $e) {
            return redirect()->route('stokIn.edit').$e->message();
        }
        $request->validate(
            [
                'produk_id' => 'required',
                'nama_tempat' => 'required',
                'qty' => 'required'
            ],
            [
                'produk_id.required' => 'Nama Produk Harus Dipilih',
                'nama_tempat.required' => 'Penempatan Produk Harus Dipiplih',
                'qty.required' => 'Jumlah Produk Harus Diisi'
            ]
        );

        // dd($request);
        $prod = Produk::findOrFail($request->produk_id);
        $prod->qty += $request->qty;
        $prod->update();

        if($request->harga_beli)
        {
            $in_hrg = $request->input('harga_beli');  // menangkap req input harga yang berupa string
            $hrg_str = preg_replace("/[^0-9]/", "", $in_hrg);  // Menghapus karakter non-angka(string)
            $hrg_int = intval($hrg_str); // mendapatkan nilai integer
        }

        $stokIn->update(
            [
                'produk_id' => $request->input('produk_id'),
                'tempat_id' => $request->input('nama_tempat'),
                'harga_beli' => $hrg_int,
                'merk' => Str::title($request->input('merk')),
                'tgl_beli' => $request->input('tgl_beli'),
                'qty' => $request->input('qty'),
            ]
        );

        if(!$request) {
            toast('Stok gagal diupdate', 'error')->autoClose(1500);
            return redirect()->route('stokIn.index');
        } else {
            toast('Stok berhasil diupdate', 'success')->autoClose(1500);
            return redirect()->route('stokIn.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StokIn  $stokIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $stokIn = StokIn::findOrFail($id);
        $produk = $stokIn->produk;

        if (($produk->qty - $stokIn->qty) < 0) {
            toast('Maaf Stok Anda Nanti Minus', 'error')->autoclose(1500);
            return redirect()->route('stokIn.index');
        } elseif($produk->qty > 0) {
            $produk->qty -= $stokIn->qty;
            $produk->save();

            $stokIn->delete();

            toast('Stok Berhasil Dihapus', 'success')->autoClose(1500);
            return redirect()->route('stokIn.index');
        } elseif($produk->qty == 0){
            $produk->qty -= 0;
            $produk->save();

            $stokIn->delete();

            toast('Stok Berhasil Dihapus', 'success')->autoClose(1500);
            return redirect()->route('stokIn.index');
        }

    }

    public function exportExcel()
    {
        return Excel::download(new StockExport, 'barang_masuk.xlsx');
        // return (new StockExport ($this->selected))->download('barang_masuk.xlsx');
    }

    public function exportPdf()
    {
        $datas = StokIn::all();
        view()->share('datas', $datas);
        $pdf = PDF::loadview('admin.stokIn.export-pdf');
        return $pdf->download('barang_masuk.pdf');
        // return view('admin.stokIn.export-pdf', compact('datas'))->with('no', 1);
    }
}
