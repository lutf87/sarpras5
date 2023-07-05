<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tempat;

class TempatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate(
            [
                'nama_tempat' => 'required'
            ],[
                'nama_tempat.required' => 'Nama Tempat Harap Diisi'
            ]
        );

        $tmp['nama_tempat'] = Str::title($request->input('nama_tempat'));
        Tempat::create($tmp);

        if (!$request) {
            toast('Tempat gagal disimpan', 'error')->autoClose(1500);
            return redirect()->route('stokIn.create');
        } else {
            toast('Tempat Berhasil disimpan', 'success')->autoClose(1500);
            return redirect()->route('stokIn.create');
        }

        // return view('admin.produk.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tempat = Tempat::findOrFail($id);
        $tempat->delete();
        toast('Tempat Berhasil Dihapus', 'success')->autoclose(1500);
        return redirect()->route('stokIn.create');
    }
}
