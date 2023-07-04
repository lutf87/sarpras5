<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id', 'kode_pinjam', 'peminjam', 'jumlah', 'kondisi_pinjam', 'kondisi_kembali', 'tgl_pinjam', 'tgl_kembali', 'status'
    ];

    protected $dates = [
        'tgl_pinjam', 'tgl_kembali'
    ];

    public function produk() {
        return $this->belongsTo(Produk::class);
    }
}
