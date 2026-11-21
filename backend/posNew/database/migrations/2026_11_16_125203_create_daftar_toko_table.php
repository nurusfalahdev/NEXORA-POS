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
        Schema::create('daftar_toko', function (Blueprint $table) {
            $table->id();
            $table->string('kode_toko')->unique();
            $table->string('nama_toko');
            $table->string('alamat');
            $table->string('no_telepon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_toko');
    }
};
