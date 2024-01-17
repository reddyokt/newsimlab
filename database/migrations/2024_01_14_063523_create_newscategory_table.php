<?php

use App\Models\NewsCategory;
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
        Schema::create('newscategory', function (Blueprint $table) {
            $table->id('id_category');
            $table->string('category');
            $table->enum('isActive', ['Yes', 'No'])->default('Yes');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
        NewsCategory::create(['category' => 'Bisnis dan Ekonomi']);
        NewsCategory::create(['category' => 'Politik']);
        NewsCategory::create(['category' => 'Agama']);  
        NewsCategory::create(['category' => 'Kesehatan']);  

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newscategory');
    }
};
