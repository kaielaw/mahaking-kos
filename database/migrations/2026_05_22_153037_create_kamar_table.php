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
        Schema::create('kamar', function (Blueprint $table) {
            $table->string('id_kamar')->primary();
            $table->string('id_kost');
            $table->integer('nomor_kamar');
            $table->integer('harga_per_bulan');
            $table->integer('harga_per_tahun');
            $table->text('ukuran');
            $table->string('tipe_kamar');
            $table->string('ketersediaan_kamar');
            $table->timestamps();

            // $table->foreign('id_kost')
            // ->references('id_kost')
            // ->on('kosts')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
