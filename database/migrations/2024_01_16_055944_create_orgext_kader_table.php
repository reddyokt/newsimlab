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
        Schema::create('orgext_kader', function (Blueprint $table) {
            $table->id('id_orgext');
            $table->unsignedBigInteger('kader_id')->index()->nullable();
            $table->foreign('kader_id')->references('kader_id')->on('kader_info')->onDelete('restrict');
            $table->string('orgextname')->nullable();
            $table->string('orgextjabatan')->nullable();
            $table->string('orgextstart')->nullable();
            $table->string('orgextend')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orgext_kader');
    }
};
