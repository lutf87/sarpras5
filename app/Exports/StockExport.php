<?php

namespace App\Exports;

use App\Models\StokIn;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class StockExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithColumnFormatting
{

    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StokIn::with('produk')->get();
    }

    public function headings(): array
    {
        return [
            'ID Stok',
            'Nama Produk',
            'Penempatan',
            'Merek',
            'Harga Beli',
            'Tanggal Pembelian',
            'Jumlah Barang Masuk',
            'Tanggal Barang Masuk',
        ];
    }

    public function map($stokIn): array {
        return [
            $stokIn->id,
            $stokIn->produk->nama_produk,
            $stokIn->tempat->nama_tempat,
            $stokIn->merk,
            $stokIn->harga_beli,
            Date::dateTimeToExcel($stokIn->tgl_beli),
            $stokIn->qty,
            Date::dateTimeToExcel($stokIn->created_at),
        ];
    }

    // public function bindVal($cell, $value) {
    //     return (new DateValueBinder())->bindVal($cell, $value);
    // }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }
}
