<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'user_role' => 'admin',
                'password' => Hash::make('admin'),
            ],
            [
                'name' => 'dita',
                'email' => 'dita@gmail.com',
                'user_role' => 'user',
                'password' => Hash::make('dita'),
            ],
            [
                'name' => 'naulan',
                'email' => 'naulan@gmail.com',
                'user_role' => 'user',
                'password' => Hash::make('dita'),
            ],
        ]
        );
    }
}
