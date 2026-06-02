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
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id(); // Primary Key (id)
            $table->string('nama');
            $table->string('email')->unique(); // Dibuat unique agar tidak ada email kembar
            $table->string('notelp');
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user'); // Membatasi inputan role
            $table->timestamps(); // Menggenerate otomatis created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunas');
    }
};
