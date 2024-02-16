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
        Schema::create('modul_report', function (Blueprint $table) {
            $table->id('id_modul_report');
            $table->unsignedBigInteger('id_modulkelas')->index();
            $table->foreign('id_modulkelas')->references('id_modulkelas')->on('modulkelas')->onDelete('restrict');
            $table->unsignedBigInteger('id_kelas')->index();
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('restrict');
            $table->unsignedBigInteger('id_periode')->index();
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('restrict');
            $table->longText('uraian_report')->nullable();
            $table->string('image_report')->nullable();
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
        Schema::dropIfExists('modul_report');
    }
};
