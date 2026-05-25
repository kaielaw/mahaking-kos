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
        Schema::create('reviews', function (Blueprint $table) {
            $table->string('id_review')->primary();
            $table->string('id_user');
            $table->string('id_kost');
            $table->integer('rating');
            $table->text('komentar');
            $table->dateTime('tanggal_review');
            $table->timestamps();

        //     Foreign Key ke users
        //     $table->foreign('id_user')
        //           ->references('id_user')
        //           ->on('users')
        //           ->onDelete('cascade');

        //     Foreign Key ke kosts
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
        Schema::dropIfExists('reviews');
    }
};
