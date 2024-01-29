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
        Schema::create('proker_image', function (Blueprint $table) {
            $table->id('id_proker_image');
            $table->unsignedBigInteger('id_proker')->index();
            $table->foreign('id_proker')->references('id_proker')->on('proker')->onDelete('restrict');
            $table->string('images_proker');
            $table->string('created_by');
            $table->string('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proker_image');
    }
};
