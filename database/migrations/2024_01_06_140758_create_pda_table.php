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
        Schema::create('pda', function (Blueprint $table) {
            $table->id('pda_id');
            $table->char('regencies_id', 4)->index();
            $table->foreign('regencies_id')->references('id')->on('regencies')->onDelete('cascade');
            $table->string('pda_name');
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
        Schema::dropIfExists('pda');
    }
};
