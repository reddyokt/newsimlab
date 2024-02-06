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
        Schema::create('bahan', function (Blueprint $table) {
            $table->id('id_bahan');
            $table->unsignedBigInteger('id_lemari');
            $table->foreign('id_lemari')->references('id_lemari')->on('lemari')->onDelete('restrict');
            $table->string('nama_bahan');
            $table->string('rumus')->nullable();
            $table->integer('jumlah');
            $table->string('images');
            $table->date('deleted_at')->nullable();
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan');
    }
};
