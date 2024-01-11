<?php

use App\Models\Role;
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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->string('CODE');
            $table->string('description')->nullable();
            $table->string('created_by');
            $table->timestamps();
        });
        Role::create(['role_name' => 'Superadmin','CODE' => 'SUP', 'created_by' => '1']);
        Role::create(['role_name' => 'Ketua PWA','CODE' => 'PWA1', 'created_by' => '1']);
        Role::create(['role_name' => 'Ketua PDA','CODE' => 'PDA1', 'created_by' => '1']);
        Role::create(['role_name' => 'Ketua Majelis dan Lembaga Wilayah','CODE' => 'MWA1', 'created_by' => '1']);
        Role::create(['role_name' => 'Ketua Majelis dan Lembaga Daerah','CODE' => 'MDA1', 'created_by' => '1']);
        Role::create(['role_name' => 'Sekretaris PWA','CODE' => 'PWA2', 'created_by' => '1']);
        Role::create(['role_name' => 'Sekretaris PDA','CODE' => 'PDA2', 'created_by' => '1']);
        Role::create(['role_name' => 'Sekretaris Majelis dan Lembaga Wilayah','CODE' => 'MWA2', 'created_by' => '1']);
        Role::create(['role_name' => 'Sekretaris Majelis dan Lembaga Daerah','CODE' => 'MDA2', 'created_by' => '1']);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
