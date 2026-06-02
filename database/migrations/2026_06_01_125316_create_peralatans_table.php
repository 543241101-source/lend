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
        Schema::create('peralatans', function (Blueprint $table) {
            $table->id(); // Primary Key (id)
            $table->string('nama_peralatan');
            $table->string('foto'); // Menyimpan path/nama file foto peralatan
            $table->string('kondisi'); // Menyimpan status kondisi (Bagus/Rusak/dll)
            $table->timestamps(); // Menggenerate otomatis created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peralatans');
    }
};
