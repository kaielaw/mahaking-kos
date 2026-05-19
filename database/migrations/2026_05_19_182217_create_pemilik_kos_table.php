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
        Schema::create('pemilik_kos', function (Blueprint $table) {
            $table->string('id_pemilik', 5)->primary();
            $table->string('id_user', 5);
            // $table->foreign('id_user')->references('id_user')->on('user');

            $table->string('nama_depan', 50);
            $table->string('nama_belakang', 50);
            $table->string('nama_bank', 50);
            $table->string('nomor_rekening', 50);
            $table->string('nama_rekening', 100);
            $table->string('no_hp', 15);
            $table->text('alamat');
            $table->enum('verifikasi_status', ['pending', 'verified', 'rejected']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemilik_kos');
    }
};
