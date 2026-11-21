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
        Schema::table('tagihan_items', function (Blueprint $table) {
            // hapus foreign key lama
            $table->dropForeign(['nota_id']);

            // hapus kolom nota_id
            $table->dropColumn('nota_id');

            // tambah kolom baru
            $table->foreignId('tagihan_id')
                ->after('id')
                ->constrained('tagihan') // sesuaikan kalau nama tabel beda
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
