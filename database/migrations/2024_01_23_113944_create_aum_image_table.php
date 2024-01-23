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
        Schema::create('aum_image', function (Blueprint $table) {
            $table->id('id_aum_image');
            $table->unsignedBigInteger('id_aum')->index()->nullable();
            $table->foreign('id_aum')->references('id_aum')->on('aum')->onDelete('restrict');
            $table->string('images')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aum_image');
    }
};
