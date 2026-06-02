<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    // 1. Arahkan ke nama tabel jamak di database kamu
    protected $table = 'penggunas';

    // 2. Sesuaikan primary key menjadi 'id'
    protected $primaryKey = 'id';

    // 3. Kembalikan ke 'nama' sesuai kolom database asli
    protected $fillable = [
        'nama',
        'email',
        'notelp',
        'password',
        'role',
    ];

    public function peminjaman()
    {
        // Parameter ke-2: Foreign Key di tabel peminjamen (id_user)
        // Parameter ke-3: Local Key / Primary Key di tabel penggunas ini (id)
        return $this->hasMany(Peminjaman::class, 'id_user', 'id');
    }
}
