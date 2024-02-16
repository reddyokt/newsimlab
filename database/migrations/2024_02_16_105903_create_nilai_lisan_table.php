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
        Schema::create('nilai_lisan', function (Blueprint $table) {
            $table->id('id_nilai_lisan');
            $table->unsignedBigInteger('id_kelas')->index();
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('restrict');
            $table->unsignedBigInteger('id_periode')->index();
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('restrict');
            $table->unsignedBigInteger('id_mahasiswa_kelas')->index();
            $table->foreign('id_mahasiswa_kelas')->references('id_mahasiswa_kelas')->on('mahasiswa_kelas')->onDelete('restrict');
            $table->integer('nilai_lisan')->nullable();
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
        Schema::dropIfExists('nilai_lisan');
    }
};
