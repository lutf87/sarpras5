<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_satuan', 'craeted_at', 'updated_at'
    ];

    function stok_in() {
        $this->hasMany(StokIn::class);
    }

}
