<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert(
            [
                'nama_kategori' => 'Lain - Lain',
                'kode_kategori' => 'ST/KAT-OTH',
                'created_at' => now(),
            ]
        );
        DB::table('kategoris')->insert(
            [
                'nama_kategori' => 'Alat Tulis Kantor',
                'kode_kategori' => 'ST/KAT-ATK',
                'created_at' => now(),
            ]
        );
        DB::table('kategoris')->insert(
            [
                'nama_kategori' => 'Alat Elektronik',
                'kode_kategori' => 'ST/KAT-ELC',
                'created_at' => now(),
            ]
        );
    }
}
