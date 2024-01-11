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
        Schema::create('userrole', function (Blueprint $table) {
            Schema::create('user_role', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->index()->nullable();
                $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
                $table->unsignedBigInteger('role_id')->nullable();
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                $table->date('delete_at')->nullable();
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userrole');
    }
};
