<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $excId = [1];
        $datas = Kategori::whereNotIn('id', $excId)->paginate(5);
        return view('admin.kategori.index', compact('datas'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori.create');
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
                'nama_kategori' => 'required',
                'kode_kategori' => 'unique:kategoris,kode_kategori|required|regex:/^\S*$/u',
            ],
            [
                'nama_kategori' => 'Nama kategori harus diisi',
                'kode_kategori' => 'Kode kategori harus diisi',
                'kode_kategori.unique' => 'Kode Kategori ini sudah ada',
                'kode_kategori.regex' => 'Maaf kode kategori tidak boleh ada spasi'
            ]
        );
        $kode = "ST/KAT-";

        Kategori::create(
            [
                'nama_kategori' => Str::title($request->input('nama_kategori')),
                'kode_kategori' => strtoupper($kode . $request->input('kode_kategori'))
            ]
        );

        if (!$request) {
            // Toastr::error('Data gagal Disimpan', 'Gagal', ["positionClass" => "toast-top-full-width"]);
            return redirect()->route('kategori.create');
        } else {
            // Toastr::success('Data berhasil Disimpan', 'Berhasil', ["positionClass" => "toast-top-center"]);
            return redirect()->route('kategori.index')->with(['success' => 'Data berhasil disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $request->validate(
            [
                'kode_kategori' => 'unique:kategoris,kode_kategori|required',
                'nama_kategori' => 'required'
            ],
            [
                'kode_kategori' => 'Kode Kategori Harus Diisi',
                'nama_kategori' => 'Nama Katogori Harus Diisi',
                'kode_kategori.unique' => 'Kode tersebut sudah digunakan!'
            ]
        );
        $kategori->fill($request->post())->save();

        if (!$request) {
            // Toastr::error('Data gagal Disimpan', 'Gagal', ["positionClass" => "toast-top-full-width"]);
            return redirect()->route('kategori.create');
        } else {
            // Toastr::success('Data berhasil Disimpan', 'Berhasil', ["positionClass" => "toast-top-center"]);
            return redirect()->route('kategori.index')->with(['success' => 'Data berhasil disimpan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        // Toastr::success('Kategori berhasil Dihapus', 'Berhasil', ["positionClass" => "toast-top-center"]);
        return redirect()->route('kategori.index');
    }
}
