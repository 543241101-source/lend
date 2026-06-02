<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();

            // Foreign Key ke tabel penggunas (id_user)
            // cascadeOnDelete() artinya jika user dihapus, data pinjamannya ikut terhapus
            $table->foreignId('id_user')->constrained('penggunas')->cascadeOnDelete();

            // Foreign Key ke tabel peralatans (id_barang)
            $table->foreignId('id_barang')->constrained('peralatans')->cascadeOnDelete();

            $table->string('evidence_foto');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable(); // Di-set nullable karena saat awal pinjam, tanggal kembali pasti masih kosong

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
