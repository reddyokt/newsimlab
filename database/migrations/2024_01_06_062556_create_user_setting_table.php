<?php

use App\Models\UserSetting;
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
        Schema::create('user_setting', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('restrict');
            $table->string('default_setting')->default('0|0|0|id');
            $table->string('created_by');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });

        UserSetting::create(['user_id' => '1', 'created_by' => 'admin']);
        UserSetting::create(['user_id' => '2', 'created_by' => 'admin']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_setting');
    }
};
