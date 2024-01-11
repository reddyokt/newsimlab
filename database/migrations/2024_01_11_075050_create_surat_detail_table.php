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
        Schema::create('surat_detail', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('surat_id')->index();
            $table->foreign('surat_id')->references('surat_id')->on('surat')->onDelete('restrict');
            $table->unsignedBigInteger('kepada_id')->index();
            $table->foreign('kepada_id')->references('user_id')->on('user')->onDelete('restrict');
            $table->unsignedBigInteger('disposisi_to')->index();
            $table->foreign('disposisi_to')->references('user_id')->on('user')->onDelete('restrict');
            $table->enum('status', ['Selesai','Belum selesai'])->default('Belum selesai');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_detail');
    }
};
