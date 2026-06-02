<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Pengguna extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // HAPUS ATAU KOMENTAR BARIS INI:
        // DB::table('penggunas')->truncate();

        DB::table('penggunas')->insert([
            [
                'nama' => 'Admin Aplikasi',
                'email' => 'admin@mail.com',
                'notelp' => '081234567890',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Budi User',
                'email' => 'budi@mail.com',
                'notelp' => '089876543210',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
