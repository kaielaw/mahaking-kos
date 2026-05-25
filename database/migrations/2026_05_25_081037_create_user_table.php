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
        Schema::create('user', function (Blueprint $table) {
            $table->string('id_user', 5)->primary(); //PK

            $table->string('nama_depan', 50);

            $table->string('nama_belakang', 50);

            $table->string('email', 50)->unique();

            $table->string('password', 255); //Dari 8 -> 255

            $table->string('nomor_hp', 15);

            $table->string('foto_profil', 255); //BLOB/STRING?

            $table->string('role', 20);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
