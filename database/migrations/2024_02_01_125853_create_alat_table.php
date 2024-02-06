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
        Schema::create('alat', function (Blueprint $table) {
            $table->id('id_alat');
            $table->enum('jenis', ['c2a', 'c2b']);
            $table->unsignedBigInteger('id_lemari');
            $table->foreign('id_lemari')->references('id_lemari')->on('lemari')->onDelete('restrict');
            $table->string('nama_alat');
            $table->string('merk_alat')->nullable();
            $table->string('ukuran_alat')->nullable();
            $table->integer('jumlah');
            $table->integer('baris');
            $table->integer('kolom');
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
        Schema::dropIfExists('alat');
    }
};
