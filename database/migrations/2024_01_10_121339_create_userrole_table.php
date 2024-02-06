<?php

use App\Models\UserRole;
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
                $table->unsignedBigInteger('user_id')->index();
                $table->foreign('user_id')->references('user_id')->on('user')->onDelete('restrict');
                $table->unsignedBigInteger('role_id')->index();
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
                $table->date('delete_at')->nullable();
                $table->timestamps();
            });
        });

        UserRole::create(['user_id' => '1', 'role_id' => '1']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userrole');
    }
};
