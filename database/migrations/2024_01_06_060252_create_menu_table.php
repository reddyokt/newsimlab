<?php

use App\Models\Menu;
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
        Schema::create('menu', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('name');
            $table->string('code');
            $table->enum('tipe_menu', ['Dashboard', 'Menu'])->default('Menu');
            $table->string('created_by');
            $table->string('updated_by');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
        Menu::create(['name' => 'Proker', 'code' => 'pr0k3r', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'News', 'code' => 'n3w5', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'Surat', 'code' => '5ur4t', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'Kader', 'code' => 'k4d3r', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'AUM', 'code' => '4um', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'Document', 'code' => 'd0c5', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'Role', 'code' => 'r0l3', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'Account', 'code' => '4cc5', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'PDA', 'code' => 'pd4', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'PCA', 'code' => 'pd4', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'Ranting', 'code' => 'r4nt1ng', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'Majelis', 'code' => 'm47el15', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'Filetype', 'code' => 'f1l3', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'Bidang Usaha', 'code' => 'b1d4ng', 'tipe_menu' => 'Menu', 'created_by' => '1']);
        Menu::create(['name' => 'Periode', 'code' => 'p3r10d3', 'tipe_menu' => 'Menu', 'created_by' => '1']);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
