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
        Schema::create('modulbahan', function (Blueprint $table) {
            $table->id('id_modulbaha');
            $table->unsignedBigInteger('id_modul')->index();
            $table->foreign('id_modul')->references('id_modul')->on('modul')->onDelete('restrict');
            $table->unsignedBigInteger('id_bahan')->index();
            $table->foreign('id_bahan')->references('id_bahan')->on('bahan')->onDelete('restrict');
            $table->integer('jumlah');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulbahan');
    }
};
