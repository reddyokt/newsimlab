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
        Schema::create('orgint_kader', function (Blueprint $table) {
            $table->id('id_orgint');
            $table->unsignedBigInteger('kader_id')->index()->nullable();
            $table->foreign('kader_id')->references('kader_id')->on('kader_info')->onDelete('restrict');
            $table->enum('orggrade', ['PPA','PWA','PDA','PCA','PRA',])->nullable();
            $table->string('orgintjabatan')->nullable();
            $table->string('orgintstart')->nullable();
            $table->string('orgintend')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orgint_kader');
    }
};
