<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::paginate(5);
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('admin.produk.index', compact('produks'))->with('no', 1);
    }

    public function create()
    {
        $kategoris = Kategori::select('id', 'nama_kategori')->get();
        return view('admin.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'nama_produk' => 'required',
                'kode_produk' => 'unique:produks,kode_produk|required|regex:/^\S*$/u',
                'kategori_produk' => 'required',
                'foto_produk' => 'image|mimes:jpeg,png,jpg,webp|file|max:2048',
            ],
            [
                'nama_produk' => 'Nama produk harus diisi',
                'kode_produk' => 'Kode produk harus diisi',
                'kategori_produk' => 'Kategori produk harus diisi',
                // 'jml_produk' => 'Jumlah produk harus diisi',
                'kode_produk.unique' => 'Kode produk ini sudah ada',
                'kode_produk.regex' => 'Maaf kode produk tidak boleh ada spasi',
                'foto_produk.image' => 'Format foto produk yang dapat diinputkan adalah jpeg, png, jpg, dan webp',
                'foto_produk.file.max' => 'Maksimal ukuran foto yang dapat diinputkan adalah 2 Mb'
            ]
        );

        if($request->file('foto_produk')){
            $img_name = time() . '_' . $request->nama_produk . '.' . $request->foto_produk->extension();
            $request->foto_produk->storeAs('produk', $img_name);
            $produk['foto_produk'] = $img_name;
        }


        // if ($request->file('foto_produk')) {
        // $img_name = time() . '_' . $request->nama_produk;
        // $extension = $request->file('foto_produk')->extension();
        // $produk['foto_produk'] = $request->file('foto_produk')->storeAs('public', $img_name . '.' . $extension);
        // $produk->foto_produk->storeAs('produk', $)


        // }

        // $in_hrg = $request->input('harga_beli');  // menangkap req input harga yang berupa string
        // $hrg_str = preg_replace("/[^0-9]/", "", $in_hrg);  // Menghapus karakter non-angka(string)
        // $hrg_int = intval($hrg_str); // mendapatkan nilai integer


        $kode = "ST/PRO-";

        $produk['nama_produk'] = Str::title($request->input('nama_produk'));
        $produk['kode_produk'] = strtoupper($kode . $request->input('kode_produk'));
        $produk['kategori_id'] = $request->input('kategori_produk');
        // $produk['harga_beli'] = $hrg_int;
        // $produk['satuan_produk'] = $request->input('satuan_produk');
        // $produk['tgl_beli'] = $request->input('tgl_beli');
        // $produk['jml_produk'] = $request->input('jml_produk');

        // dd($produk);
        Produk::create($produk);

        if (!$request) {
            // Toastr::error('Data gagal Disimpan', 'Gagal', ["positionClass" => "toast-top-full-width"]);
            toast('Produk gagal disimpan', 'error')->autoClose(1500);
            return redirect()->route('produk.create');
        } else {
            // Toastr::success('Data berhasil Disimpan', 'Berhasil', ["positionClass" => "toast-top-center"]);
            toast('Produk Berhasil disimpan', 'success')->autoClose(1500);
            return redirect()->route('produk.index');
        }

        return view('admin.produk.index');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        // $rupiah = $produk->harga_beli;
        // $format = 'Rp. '.number_format($rupiah, 0, ',', '.');
        // dd($produk);
        // $tanggal_beli = Carbon::parse($produk->tgl_beli)->locale('id')->isoFormat('dddd, D MMMM YYYY');

        // $satuan = $produk->satuan_produk;

        // if($satuan == "Rim")
        // {
        //     $jml = 1*500;
        //     $sum = $produk->jml_produk * $jml." Lembar";
        //     // dd($sum);
        // } else if($satuan == "Lusin") {
        //     $jml = 1*12;
        //     $sum = $produk->jml_produk * $jml." Buah";
        // }

        return view('admin.produk.show', compact('produk'));
    }

    public function edit(Produk $produk, Kategori $kategori, $id)
    {
        $produk = Produk::findOrFail($id);

        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('admin.produk.edit', compact('produk', 'kategoris'));

        // dd($produk);
    }

    public function update(Request $request, Produk $produk, $id)
    {
        $produk = Produk::findOrFail($id);
        // $produk->delete();
        $request->validate(
            [
                'nama_produk' => 'required',
                'kode_produk' => 'required|regex:/^\S*$/u',
                'kategori_produk' => 'required',
                'foto_produk' => 'image|mimes:jpeg,png,jpg,webp|file|max:2048',
            ],
            [
                'nama_produk' => 'Nama produk harus diisi',
                'kode_produk' => 'Kode produk harus diisi',
                'kategori_produk' => 'Kategori produk harus diisi',
                // 'kode_produk.unique' => 'Kode produk ini sudah ada',
                'kode_produk.regex' => 'Maaf kode produk tidak boleh ada spasi',
                'foto_produk.image' => 'Format foto produk yang dapat diinputkan adalah jpeg, png, jpg, dan webp',
                'foto_produk.file.max' => 'Maksimal ukuran foto yang dapat diinputkan adalah 2 Mb'
            ]
        );

        if ($request->hasFile('foto_produk')) {

            // $imageName = $request->nama_guru . '.' . $request->img->extension();
            // $request->img->storeAs('gurus/', $imageName);

            // Storage::delete('gurus/' . $guru->img);

            // $img_name = time() . '_' . $request->nama_produk;
            // $extension = $request->file('foto_produk')->extension();
            // $produk['foto_produk'] = $request->file('foto_produk')->storeAs('produk', $img_name . '.' . $extension);

            $img_name = time() . '_' . $request->nama_produk . '.' . $request->foto_produk->extension();
            $request->foto_produk->storeAs('produk', $img_name);

            // $foto_produk = "produk/" . $img_name . '.' . $extension;

            Storage::delete('produk/' . $produk->foto_produk);

            $produk->update([
                'nama_produk' => $request->nama_produk,
                'kode_produk' => $request->kode_produk,
                'kategori_id' => $request->kategori_produk,
                'foto_produk' => $img_name,
            ]);
        } else {

            //update post without image
            $produk->update([
                'nama_produk' => $request->nama_produk,
                'kode_produk' => $request->kode_produk,
                'kategori_id' => $request->kategori_produk,
            ]);
        }

        // $produk->delete();
        // $request->validate(
        //     [
        //         'nama_produk' => 'required',
        //         'kode_produk' => 'unique:produks,kode_produk|required|regex:/^\S*$/u',
        //         'kategori_produk' => 'required',
        //         'foto_produk' => 'image|mimes:jpeg,png,jpg,webp|file|max:2048',
        //     ],
        //     [
        //         'nama_produk' => 'Nama produk harus diisi',
        //         'kode_produk' => 'Kode produk harus diisi',
        //         'kategori_produk' => 'Kategori produk harus diisi',
        //         'kode_produk.unique' => 'Kode produk ini sudah ada',
        //         'kode_produk.regex' => 'Maaf kode produk tidak boleh ada spasi',
        //         'foto_produk.image' => 'Format foto produk yang dapat diinputkan adalah jpeg, png, jpg, dan webp',
        //         'foto_produk.file.max' => 'Maksimal ukuran foto yang dapat diinputkan adalah 2 Mb'
        //     ]
        // );

        // if ($request->hasFile('foto_produk')) {
        //     // get ID
        //     $exist = Storage::disk('local')->exists('produk' . $produk->foto_produk);

        //     // hapus foto lama
        //     if ($exist) {
        //         Storage::disk('local')->delete('produk/' . $produk->foto_produk);
        //     }

        //     // masukkan foto baru bila ada
        //     if ($request->file('foto_produk')) {
        //         $img_name = time() . '_' . $request->nama_produk;
        //         $extension = $request->file('foto_produk')->extension();
        //         $produk['foto_produk'] = $request->file('foto_produk')->storeAs('produk', $img_name . '.' . $extension);
        //     }
        // }

        // $kode = "ST/PRO-";

        // $produk['nama_produk'] = Str::title($request->input('nama_produk'));
        // $produk['kode_produk'] = strtoupper($kode . $request->input('kode_produk'));
        // $produk['kategori_id'] = $request->input('kategori_produk');

        // Produk::create($produk);

        if (!$request) {
            toast('Produk gagal disimpan', 'error')->autoClose(1500);
            return redirect()->route('produk.create');
        } else {
            toast('Produk Berhasil disimpan', 'success')->autoClose(1500);
            return redirect()->route('produk.index');
        }
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // dd($exists);

        // delete old image
        Storage::delete('produk/' . $produk->foto_produk);
        $produk->delete();


        toast('Produk Berhasil Dihapus', 'success')->autoClose(1500);
        return redirect()->route('produk.index');
    }
}
