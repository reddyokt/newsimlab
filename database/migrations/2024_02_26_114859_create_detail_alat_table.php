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
        Schema::create('detail_alat', function (Blueprint $table) {
            $table->id('id_detail_alat');
            $table->unsignedBigInteger('id_alat')->index();
            $table->foreign('id_alat')->references('id_alat')->on('alat')->onDelete('restrict');
            $table->unsignedBigInteger('sub_id_alat');
            $table->enum('condition',['good','need_repair','bad'])->nullable();
            $table->longText('description')->nullable();
            $table->date('date_calibration')->nullable();
            $table->string('file')->nullable();
            $table->string('qrcode')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_alat');
    }
};
