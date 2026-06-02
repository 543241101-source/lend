<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory;

protected $table = 'peralatans'; // Sesuai dengan yang ada di MySQL kamu
protected $primaryKey = 'id';

    protected $fillable = [
        'nama_peralatan',
        'foto',
        'kondisi',
    ];

    /**
     * Relasi ke tabel Peminjaman (One to Many)
     * Satu alat lab bisa memiliki riwayat banyak peminjaman
     */
    public function peminjaman()
    {
        // Parameter ke-2: Foreign Key di tabel peminjaman (id_barang)
        // Parameter ke-3: Local Key / Primary Key di tabel peralatan ini (id)
        return $this->hasMany(Peminjaman::class, 'id_barang', 'id');
    }
}
