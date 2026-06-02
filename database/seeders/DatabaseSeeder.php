<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil kelas seeder buatan kita dengan urutan yang benar
        $this->call([
            UserSeeder::class,
            Pengguna::class,
            Peralatan::class,
            Peminjaman::class,
        ]);
    }
}
