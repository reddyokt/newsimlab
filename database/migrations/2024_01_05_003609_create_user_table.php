<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            $table->string('profile_picture')->nullable();
            $table->enum('isActive', ['Y', 'N'])->default('N');
            $table->unsignedBigInteger('pda_id')->nullable();
            $table->foreign('pda_id')->references('pda_id')->on('pda')->onDelete('restrict');
            $table->unsignedBigInteger('id_majelis')->nullable();
            $table->foreign('id_majelis')->references('id_majelis')->on('majelis')->onDelete('restrict');
            $table->string('created_by');
            $table->date('delete_at')->nullable();
            $table->timestamps();
        });

        User::create(['name' => 'Superadmin', 'username' => 'admin', 'password' => Hash::make('qwerty'), 'phone' => '087885481350', 'email' => 'reddyoktariawan@gmail.com', 'created_by' => 'admin']);
        User::create(['name' => 'Ketua PWA', 'username' => 'jkt1', 'password' => Hash::make('qwerty'), 'phone' => '087885481350', 'email' => 'reddyoktariawan@gmail.com', 'created_by' => 'admin']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
