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
        Schema::create('document', function (Blueprint $table) {
            $table->id('id_doc');
            $table->unsignedBigInteger('id_filetype')->index();
            $table->foreign('id_filetype')->references('id_filetype')->on('filetype')->onDelete('restrict');
            $table->unsignedBigInteger('pda_id')->index()->nullable();
            $table->foreign('pda_id')->references('pda_id')->on('pda')->onDelete('restrict');
            $table->unsignedBigInteger('pca_id')->index()->nullable();
            $table->foreign('pca_id')->references('pca_id')->on('pca')->onDelete('restrict');
            $table->string('docname');
            $table->string('uploaded_doc')->nullable();
            $table->string('created_by');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document');
    }
};
