<?php

namespace App\Exports;

use App\Models\StokIn;
use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockAllExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Produk::all();
    // }

    public function query(){
        return Produk::query()->select('id', 'nama_produk', 'kode_produk', 'kategori_id', 'qty');
    }

    public function headings(): array
    {
        return [
            'id barang',
            'nama_barang',
            'kode produk',
            'id kategori',
            'qty',
        ];
    }
}
