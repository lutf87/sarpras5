<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk', 'kode_produk', 'kategori_id', 'foto_produk'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    function stok_in(){
        return $this->hasMany(StokIn::class);
    }
}
