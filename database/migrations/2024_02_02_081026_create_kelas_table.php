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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->unsignedBigInteger('id_periode')->index();
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('restrict');
            $table->unsignedBigInteger('id_matkul')->index();
            $table->foreign('id_matkul')->references('id_matkul')->on('matkul')->onDelete('restrict');
            $table->string('kode_matkul');
            $table->string('nama_kelas');
            $table->unsignedBigInteger('id_dosen')->index();
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen')->onDelete('restrict');
            $table->unsignedBigInteger('id_aslab')->index()->nullable();
            $table->foreign('id_aslab')->references('id_aslab')->on('aslab')->onDelete('restrict');
            $table->enum('status',['active','not_active'])->default('active');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
