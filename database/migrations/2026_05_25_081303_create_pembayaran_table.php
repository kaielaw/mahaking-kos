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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->string('id_pembayaran', 5)->primary(); //PK

            $table->string('id_booking', 5);
            $table->foreign('id_booking')->references('id_booking')->on('booking'); //FK

            $table->string('metode_pembayaran', 50);

            $table->string('nama_bank', 50);

            $table->string('nomor_rekening', 50);

            $table->string('nama_rekening', 100);

            $table->decimal('biaya_sewa', 12, 2);

            $table->decimal('biaya_admin', 12, 2);

            $table->decimal('jumlah', 12, 2);

            $table->dateTime('tanggal_bayar');

            $table->string('bukti_pembayaran', 255);

            $table->enum('status_pembayaran', ['pending', 'dibayar', 'gagal']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
