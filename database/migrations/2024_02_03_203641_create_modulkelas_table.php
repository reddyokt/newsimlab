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
        Schema::create('modulkelas', function (Blueprint $table) {
            $table->id('id_modulkelas');
            $table->unsignedBigInteger('id_modul')->index();
            $table->foreign('id_modul')->references('id_modul')->on('modul')->onDelete('restrict');
            $table->unsignedBigInteger('id_kelas')->index();
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('restrict');
            $table->unsignedBigInteger('id_periode')->index();
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('restrict');
            $table->date('tanggal_praktek');
            $table->enum('isUsed',['Yes','No'])->default('No');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulkelas');
    }
};
