<?php

namespace App\Exports;

use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProdukExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{

    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Produk::with('stokout')->get();
    }

    public function headings(): array
    {
        return [
            'ID Barang',
            'Nama Barang',
            'Kategori',
            'Total Barang Masuk',
            'Total Barang Keluar',
            'Total Stok Barang'
        ];
    }

    public function map($produk): array {
        return [
            $produk->id,
            $produk->nama_produk,
            $produk->kategori->nama_kategori,
            $produk->stokin->sum('qty'),
            $produk->stokout->sum('qty'),
            $produk->sum('qty')
        ];
    }
}
