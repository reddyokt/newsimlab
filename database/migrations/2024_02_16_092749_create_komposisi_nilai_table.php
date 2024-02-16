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
        Schema::create('komposisi_nilai', function (Blueprint $table) {
            $table->id('id_komponen');
            $table->enum('nama_komponen',['Pre Test', 'Post Test', 'Report', 'Subjectif', 'Awal', 'Akhir', 'Lisan']);
            $table->integer('nilai_komponen');
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
        Schema::dropIfExists('komposisi_nilai');
    }
};
