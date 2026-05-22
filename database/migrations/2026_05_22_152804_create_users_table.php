<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->string('id_user')->primary();

            $table->string('nama_depan');

            $table->string('nama_belakang');

            $table->string('email')->unique();

            $table->string('password');

            $table->string('nomor_hp');

            $table->string('foto_profil')->nullable();

            $table->string('role');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};