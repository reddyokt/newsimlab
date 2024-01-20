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
        Schema::create('prokerdetail', function (Blueprint $table) {
            $table->id('id_prokerdetail');
            $table->unsignedBigInteger('id_proker')->index();
            $table->foreign('id_proker')->references('id_proker')->on('proker')->onDelete('restrict');
            $table->longText('description');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prokerdetail');
    }
};
