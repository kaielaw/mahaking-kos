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
        Schema::create('foto_kos', function (Blueprint $table) {
            $table->string('id_foto', 5)->primary(); //PK

            $table->string('id_kos', 5);
            $table->foreign('id_kos')->references('id_kos')->on('kos'); //FK

            $table->text('url_foto');

            $table->text('caption');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_kos');
    }
};
