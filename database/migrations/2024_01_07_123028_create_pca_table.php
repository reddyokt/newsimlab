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
        Schema::create('pca', function (Blueprint $table) {
            $table->id('pca_id');
            $table->char('district_id', 7);
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('restrict');
            $table->unsignedBigInteger('pda_id');
            $table->foreign('pda_id')->references('pda_id')->on('pda')->onDelete('restrict');
            $table->string('pca_name');
            $table->longText('address')->nullable();
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
        Schema::dropIfExists('pca');
    }
};
