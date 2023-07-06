<?php

namespace App\Exports;

use App\Models\StokOut;
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

class StockOutExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithColumnFormatting
{

    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StokOut::with('produk')->get();
    }

    public function headings(): array
    {
        return [
            'ID Stok',
            'Nama Produk',
            'Jumlah Produk Keluar',
            'Tanggal Keluar',
            'Pemohon',
            'Keterangan',
        ];
    }

    public function map($stokOut): array {
        return [
            $stokOut->id,
            $stokOut->produk->nama_produk,
            $stokOut->qty,
            Date::dateTimeToExcel($stokOut->created_at),
            $stokOut->pemohon,
            $stokOut->keterangan,
        ];
    }

    // public function bindVal($cell, $value) {
    //     return (new DateValueBinder())->bindVal($cell, $value);
    // }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'G' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }
}
