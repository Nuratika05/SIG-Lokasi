<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class JenisLokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_lokasi')->insert([
            ['nama' => 'Penginapan'],
            ['nama' => 'Tempat Makan'],
            ['nama' => 'Wisata'],
            ['nama' => 'Halte Bus'],
            ['nama' => 'Bank'],
        ]);

    }
}
