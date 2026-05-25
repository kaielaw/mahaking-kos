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
        Schema::create('foto_kost', function (Blueprint $table) {

            $table->string('id_foto')->primary();

            $table->string('id_kost');

            $table->string('foto_kost');

            $table->text('deskripsi_foto')->nullable();

            $table->timestamps();

        // Foreign Key
        //     $table->foreign('id_kost')
        //           ->references('id_kost')
        //           ->on('kosts')
        //           ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_kost');
    }
};