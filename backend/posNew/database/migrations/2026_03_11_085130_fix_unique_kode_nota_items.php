<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nota_items', function (Blueprint $table) {

            // hapus unique lama
            $table->dropUnique('nota_items_kode_unique');

            // buat unique baru
            $table->unique(['nota_id', 'kode'], 'nota_kode_unique');
        });
    }

    public function down(): void
    {
        Schema::table('nota_items', function (Blueprint $table) {

            $table->dropUnique('nota_kode_unique');

            $table->unique('kode', 'nota_items_kode_unique');
        });
    }
};
