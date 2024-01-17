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
        Schema::create('training_kader', function (Blueprint $table) {
            $table->id('id_training');
            $table->unsignedBigInteger('kader_id')->index()->nullable();
            $table->foreign('kader_id')->references('kader_id')->on('kader_info')->onDelete('restrict');
            $table->enum('trainingtype', ['Internal', 'Eksternal'])->nullable();
            $table->string('trainingname')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_kader');
    }
};
