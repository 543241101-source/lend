<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Peminjaman extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('penggunas')->first()?->id ?? 1;
        $barangId = DB::table('peralatans')->first()?->id ?? 1;

        // UBAH 'peminjamans' MENJADI 'peminjamen' DI BAWAH INI
        DB::table('peminjamen')->insert([
            [
                'id_user' => $userId,
                'id_barang' => $barangId,
                'evidence_foto' => 'evidence/sample_bukti1.jpg',
                'tanggal_pinjam' => now()->subDays(5)->format('Y-m-d'),
                'tanggal_kembali' => now()->subDays(2)->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => $userId,
                'id_barang' => $barangId,
                'evidence_foto' => 'evidence/sample_bukti2.jpg',
                'tanggal_pinjam' => now()->format('Y-m-d'),
                'tanggal_kembali' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
