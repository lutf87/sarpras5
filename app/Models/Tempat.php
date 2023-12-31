<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tempat', 'created_at', 'updated_at'
    ];

    function produk(){
        $this->hasMany(StokIn::class);
    }
}
