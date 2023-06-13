<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('satuans')->insert(
            [
                'nama_satuan' => 'Rim',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('satuans')->insert(
            [
                'nama_satuan' => 'Gross',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );DB::table('satuans')->insert(
            [
                'nama_satuan' => 'Kodi',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );DB::table('satuans')->insert(
            [
                'nama_satuan' => 'Lusin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );DB::table('satuans')->insert(
            [
                'nama_satuan' => 'Buah',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );DB::table('satuans')->insert(
            [
                'nama_satuan' => 'Gross',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );DB::table('satuans')->insert(
            [
                'nama_satuan' => 'Set',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );DB::table('satuans')->insert(
            [
                'nama_satuan' => 'Ruang',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );DB::table('satuans')->insert(
            [
                'nama_satuan' => 'Pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );DB::table('satuans')->insert(
            [
                'nama_satuan' => 'Dus',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );DB::table('satuans')->insert(
            [
                'nama_satuan' => 'Box',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );DB::table('satuans')->insert(
            [
                'nama_satuan' => 'Lembar',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
