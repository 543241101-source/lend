<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Peralatan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('peralatans')->insert([
            [
                'nama_peralatan' => 'Proyektor Epson EB-X400',
                'foto' => 'peralatan/proyektor.jpg', // Path dummy untuk foto alat
                'kondisi' => 'Bagus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_peralatan' => 'Kamera Canon EOS 3000D',
                'foto' => 'peralatan/kamera.jpg',
                'kondisi' => 'Bagus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_peralatan' => 'Kabel HDMI 15 Meter',
                'foto' => 'peralatan/kabel-hdmi.jpg',
                'kondisi' => 'Rusak Ringan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
