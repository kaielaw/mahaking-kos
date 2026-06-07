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
        Schema::create('booking', function (Blueprint $table) {
            $table->string('id_booking', 5)->primary(); //PK

            $table->string('id_user', 5);
            $table->foreign('id_user')->references('id_user')->on('user'); //FK

            $table->string('id_kamar', 5);
            $table->foreign('id_kamar')->references('id_kamar')->on('kamar'); //FK

            $table->dateTime('tanggal_booking');

            $table->date('tanggal_masuk');

            $table->date('tanggal_keluar');

            $table->decimal('total_harga', 12, 2);

            $table->enum('status_booking', [
                'pending',
                'diterima',
                'dibatalkan',
                'selesai'
            ]);

            $table->text('catatan_penyewa')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
