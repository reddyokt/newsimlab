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
        Schema::create('absen', function (Blueprint $table) {
            $table->id('id_absen');
            $table->unsignedBigInteger('id_mahasiswa_kelas')->index();
            $table->foreign('id_mahasiswa_kelas')->references('id_mahasiswa_kelas')->on('mahasiswa_kelas')->onDelete('restrict');
            $table->unsignedBigInteger('id_modulkelas')->index();
            $table->foreign('id_modulkelas')->references('id_modulkelas')->on('modulkelas')->onDelete('restrict');
            $table->unsignedBigInteger('id_kelas')->index();
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('restrict');
            $table->unsignedBigInteger('id_periode')->index();
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('restrict');
            $table->boolean('isAbsen');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen');
    }
};
