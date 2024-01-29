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
        Schema::create('proker', function (Blueprint $table) {
            $table->id('id_proker');
            $table->unsignedBigInteger('id_periode')->index();
            $table->foreign('id_periode')->references('id_periode')->on('periode')->onDelete('restrict');
            $table->unsignedBigInteger('pda_id');
            $table->foreign('pda_id')->references('pda_id')->on('pda')->onDelete('restrict');
            $table->unsignedBigInteger('id_majelis');
            $table->foreign('id_majelis')->references('id_majelis')->on('majelis')->onDelete('restrict');
            $table->string('pelaksana');
            $table->enum('typeproker',['majelis', 'non-majelis']);
            $table->string('proker_name');
            $table->date('prokerstart');
            $table->date('prokerend');
            $table->string('anggaran');
            $table->enum('status', ['waiting','validatedbymda','validatedbypda','validatedbypwa','rejectbymda',
                         'rejectbypda','rejectbypwa','on-progress','realized', 'unrealized'])->default('waiting');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('user_id')->on('user')->onDelete('restrict');
            $table->string('updated_by')->nullable();
            $table->longText('description');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proker');
    }
};
