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
        Schema::create('kader_info', function (Blueprint $table) {
            $table->id('kader_id');
            $table->string('kader_name');
            $table->string('kader_phone')->nullable();
            $table->string('kader_email')->nullable();
            $table->enum('gender',['Perempuan', 'Laki=laki']);
            $table->enum('marital',['Sudah kawin', 'Belum kawin', 'Pernah kawin']);
            $table->string('anak')->nullable();
            $table->longText('address')->nullable();
            $table->integer('nba')->nullable();
            $table->integer('nbm')->nullable();
            $table->unsignedBigInteger('ranting_id')->index()->nullable();
            $table->foreign('ranting_id')->references('ranting_id')->on('ranting')->onDelete('restrict');
            $table->unsignedBigInteger('pekerjaan_id')->index()->nullable();
            $table->foreign('pekerjaan_id')->references('id_pekerjaan')->on('pekerjaan')->onDelete('restrict');
            $table->enum('status', ['waiting', 'valid', 'declined'])->default('waiting');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kader_info');
    }
};
