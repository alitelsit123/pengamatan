<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'username' => 'elyas094',
            'password' => Hash::make('admin')
        ]);
        DB::table('users')->insert([
            'username' => 'ekopurnomo',
            'password' => Hash::make('admin')
        ]);
        DB::table('users')->insert([
            'username' => 'penguji',
            'password' => Hash::make('admin')
        ]);
    }
}
