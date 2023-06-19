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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('Nim');
            $table->string('Nama');
            $table->date('ttl');
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->string('Jurusan');
            $table->string('No_Handphone');
            $table->string('Email');
            $table->string('image_profile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
