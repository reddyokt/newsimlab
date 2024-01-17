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
        Schema::create('edu_kader', function (Blueprint $table) {
            $table->id('id_edu');
            $table->unsignedBigInteger('kader_id')->index()->nullable();
            $table->foreign('kader_id')->references('kader_id')->on('kader_info')->onDelete('restrict');
            $table->enum('jenjang', ['SD','SMP', 'SMA', 'S1', 'S2', 'S3'])->nullable();
            $table->string('eduyear')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edu_kader');
    }
};
