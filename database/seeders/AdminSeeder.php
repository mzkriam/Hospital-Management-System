<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->delete();
        DB::table('admins')->insert([
            // 'name' => Str::random(10),
            // 'email' => Str::random(10) . '@gmail.com',
            // 'password' => Hash::make('password'),
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
