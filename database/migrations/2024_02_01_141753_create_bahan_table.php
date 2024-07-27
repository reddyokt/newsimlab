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
            $table->unsignedBigInteger('id_lemari')->nullable();
            $table->foreign('id_lemari')->references('id_lemari')->on('lemari')->onDelete('restrict');
            $table->string('nama_bahan');
            $table->string('rumus')->nullable();
            $table->integer('jumlah');
            $table->enum('fase',['Padat','Cair','Gas']);
            $table->enum('satuan',['mg','ml']);
            $table->string('images')->nullable();
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
