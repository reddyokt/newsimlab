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
        Schema::create('news', function (Blueprint $table) {
            $table->id('news_id');
            $table->unsignedBigInteger('id_category')->index();
            $table->foreign('id_category')->references('id_category')->on('newscategory')->onDelete('restrict');
            $table->string('news_title');
            $table->string('slug');
            $table->longText('news_body');
            $table->string('feature_image');
            $table->string('images')->nullable();
            $table->enum('status', ['waiting','published','unpublished'])->default('waiting');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('user_id')->on('user')->onDelete('restrict');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('user_id')->on('user')->onDelete('restrict');
            $table->timestamps();
            $table->date('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
