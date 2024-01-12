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
        Schema::create('ranting', function (Blueprint $table) {
            $table->id('ranting_id');
            $table->unsignedBigInteger('pca_id')->index();
            $table->foreign('pca_id')->references('pca_id')->on('pca')->onDelete('restrict');
            $table->char('villages_id', 10)->index();
            $table->foreign('villages_id')->references('id')->on('villages')->onDelete('restrict');
            $table->string('ranting_name');
            $table->longText('address')->nullable();
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranting');
    }
};
