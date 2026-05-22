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

            $table->string('id_booking', 5)->primary();

            $table->string('kode_booking', 20);

            //$table->string('id_user', 5); (FK)

            //$table->string('id_kamar', 5); (FK)

            $table->date('tanggal_booking');

            $table->date('tanggal_masuk');

            $table->date('tanggal_keluar');

            $table->integer('durasi_sewa');

            $table->integer('total_harga');

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
        Schema::dropIfExists('bookings');
    }
};
