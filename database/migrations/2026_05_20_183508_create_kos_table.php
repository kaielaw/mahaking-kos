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
        Schema::create('kos', function (Blueprint $table) {

            $table->string('id_kos', 5)->primary(); //PK

            $table->string('id_pemilik', 5);
            $table->foreign('id_pemilik')->references('id_pemilik')->on('pemilik_kos'); //FK

            $table->string('id_lokasi', 5);
            $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasi'); //FK

            $table->string('nama_kos', 100);

            $table->text('alamat');

            $table->text('deskripsi');

            $table->string('tipe_kos', 50);

            $table->enum('jenis_kos', [
                'putra',
                'putri',
                'campur'
            ]);

            $table->decimal('harga_min', 12, 2);

            $table->decimal('harga_max', 12, 2);

            $table->integer('jumlah_kamar');

            $table->integer('jumlah_kamar_tersedia');

            $table->text('aturan_kos');

            $table->float('rating_rata2')->nullable();

            $table->integer('total_review')->default(0);

            $table->enum('status_ketersediaan', [
                'tersedia',
                'penuh'
            ]);

            $table->enum('status_verifikasi', [
                'pending',
                'verified',
                'rejected'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};
