<?php

namespace App\Exports;

use App\Models\StokIn;
use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;


class StockExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     $produk = Produk::orderBy('id')->get();

    //     return StokIn::where('produk.id', $produk);
    // }

    public function query(){
        return StokIn::query()->select('id', 'produk_id', 'tempat_id', 'harga_beli', 'tgl_beli','qty');
    }

    public function headings(): array
    {
        return [
            'id barang masuk',
            'id barang/produk',
            'id tempat',
            'harga beli',
            'tgl_beli',
            'qty',
        ];
    }


}
