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
        Schema::create('modul', function (Blueprint $table) {
            $table->id('id_modul');
            $table->unsignedBigInteger('id_matkul')->index();
            $table->foreign('id_matkul')->references('id_matkul')->on('matkul')->onDelete('restrict');
            $table->string('modul_name');
            $table->string('created_by');
            $table->enum('status',['used','unused'])->default('unused');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modul');
    }
};
