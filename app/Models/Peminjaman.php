<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // 1. Set nama tabel sesuai DB kamu
    protected $table = 'peminjamen';

    // 2. Set primary key menjadi 'id' sesuai hasil dd() tadi
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'id_barang',
        'evidence_foto',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

    public function pengguna()
{
    // Parameter ke-2: id_user (kolom foreign key di tabel peminjamen)
    // Parameter ke-3: id (kolom primary key asli di tabel penggunas)
    return $this->belongsTo(Pengguna::class, 'id_user', 'id');
}

    public function peralatan()
    {
        return $this->belongsTo(Peralatan::class, 'id_barang', 'id');
    }
}
