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
        Schema::create('user', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('username');
            $table->string('password');
            $table->string('phone');
            $table->string('email');
            $table->string('profile_picture');
            $table->enum('isActive', ['Y', 'N'])->default('N');
            $table->unsignedBigInteger('pda_id')->nullable();
            $table->foreign('pda_id')->references('pda_id')->on('pda')->onDelete('restrict');
            $table->string('created_by');
            $table->date('delete_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
