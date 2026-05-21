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
        Schema::create('detail_fasilitas', function (Blueprint $table) {

            $table->string('id_detail_fasilitas', 5)->primary();

            $table->string('id_kos', 5); //(FK)

            $table->string('id_fasilitas', 5); //(FK)

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_fasilitas');
    }
};
