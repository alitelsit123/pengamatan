<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MetarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metar')->insert([
            'username' => 'elyas094',
            'password' => Hash::make('admin')
        ]);
    }
}
