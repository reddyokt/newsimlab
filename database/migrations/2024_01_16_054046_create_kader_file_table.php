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
        Schema::create('kader_file', function (Blueprint $table) {
            $table->id('id_kader_file');
            $table->unsignedBigInteger('kader_id')->index();
            $table->foreign('kader_id')->references('kader_id')->on('kader_info')->onDelete('restrict');
            $table->string('filepp')->nullable();
            $table->string('filenbma')->nullable();
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kader_file');
    }
};
