<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('penelitian', function (Blueprint $table) {
            $table->id('penelitian_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('restrict');
            $table->enum('jenis', ['mahasiswa', 'dosen', 'umum'])->nullable();
            $table->date('starting')->nullable();
            $table->date('ended')->nullable();
            $table->enum('status', [
                'waiting',
                'rejectbydosen',
                'acceptbydosen',
                'rejectbyso',
                'acceptbyso',
                'rejectbylaboran',
                'acceptbylaboran',
                'valid',
                'progress',
                'ended'
            ])->default('waiting');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();  // Ini akan membuat kolom created_at dan updated_at
            $table->softDeletes(); // Ini akan membuat kolom deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penelitian');
    }
};
