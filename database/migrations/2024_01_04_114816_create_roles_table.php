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
        Role::create(['role_name' => 'Kepala Lab','CODE' => 'KAL', 'created_by' => '1']);
        Role::create(['role_name' => 'Dosen Pengampu','CODE' => 'DPA', 'created_by' => '1']);
        Role::create(['role_name' => 'Laboran','CODE' => 'LBO', 'created_by' => '1']);
        Role::create(['role_name' => 'Asisten Lab','CODE' => 'ASL', 'created_by' => '1']);
        Role::create(['role_name' => 'Mahasiswa','CODE' => 'MHS', 'created_by' => '1']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
