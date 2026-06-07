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
        Schema::create('wishlist', function (Blueprint $table) {
            $table->string('id_favorit', 5)->primary(); //PK

            $table->string('id_user', 5);
            $table->foreign('id_user')->references('id_user')->on('user'); //FK

            $table->string('id_kos', 5);
            $table->foreign('id_kos')->references('id_kos')->on('kos'); //FK
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist');
    }
};
