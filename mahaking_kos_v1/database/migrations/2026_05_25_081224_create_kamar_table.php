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
            $table->string('id_kamar', 5)->primary(); //PK

            $table->string('id_kos', 5);
            $table->foreign('id_kos')->references('id_kos')->on('kos'); //FK

            $table->integer('nomor_kamar');

            $table->decimal('harga_per_bulan', 12, 2);

            $table->decimal('harga_per_tahun', 12, 2);

            $table->text('ukuran');

            $table->string('tipe_kamar', 20);

            $table->string('ketersediaan_kamar', 20);

            $table->timestamps();

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
