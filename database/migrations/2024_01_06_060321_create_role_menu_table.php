<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\RoleMenu;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('menu_id')->on('menu')->onDelete('cascade');
            $table->timestamps();
        });
        RoleMenu::create(['role_id' => '1', 'menu_id' => '1']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '2']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '3']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '4']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '5']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '6']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '7']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '8']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '9']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '10']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '11']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '12']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '13']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '14']);
        RoleMenu::create(['role_id' => '1', 'menu_id' => '15']);

        RoleMenu::create(['role_id' => '2', 'menu_id' => '1']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '2']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '3']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '4']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '5']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '6']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '7']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '8']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '9']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '10']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '11']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '12']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '13']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '14']);
        RoleMenu::create(['role_id' => '2', 'menu_id' => '15']);

        RoleMenu::create(['role_id' => '3', 'menu_id' => '1']);
        RoleMenu::create(['role_id' => '3', 'menu_id' => '2']);
        RoleMenu::create(['role_id' => '3', 'menu_id' => '3']);
        RoleMenu::create(['role_id' => '3', 'menu_id' => '4']);
        RoleMenu::create(['role_id' => '3', 'menu_id' => '5']);
        RoleMenu::create(['role_id' => '3', 'menu_id' => '6']);
        RoleMenu::create(['role_id' => '3', 'menu_id' => '8']);
        RoleMenu::create(['role_id' => '3', 'menu_id' => '10']);
        RoleMenu::create(['role_id' => '3', 'menu_id' => '11']);
        RoleMenu::create(['role_id' => '3', 'menu_id' => '13']);
        RoleMenu::create(['role_id' => '3', 'menu_id' => '14']);

        RoleMenu::create(['role_id' => '4', 'menu_id' => '1']);
        RoleMenu::create(['role_id' => '4', 'menu_id' => '2']);
        RoleMenu::create(['role_id' => '4', 'menu_id' => '3']);
        RoleMenu::create(['role_id' => '4', 'menu_id' => '4']);
        RoleMenu::create(['role_id' => '4', 'menu_id' => '5']);
        RoleMenu::create(['role_id' => '4', 'menu_id' => '6']);
        RoleMenu::create(['role_id' => '4', 'menu_id' => '12']);

        RoleMenu::create(['role_id' => '5', 'menu_id' => '1']);
        RoleMenu::create(['role_id' => '5', 'menu_id' => '2']);
        RoleMenu::create(['role_id' => '5', 'menu_id' => '3']);
        RoleMenu::create(['role_id' => '5', 'menu_id' => '4']);
        RoleMenu::create(['role_id' => '5', 'menu_id' => '5']);
        RoleMenu::create(['role_id' => '5', 'menu_id' => '6']);
        RoleMenu::create(['role_id' => '5', 'menu_id' => '12']);

        RoleMenu::create(['role_id' => '6', 'menu_id' => '1']);
        RoleMenu::create(['role_id' => '6', 'menu_id' => '2']);
        RoleMenu::create(['role_id' => '6', 'menu_id' => '3']);
        RoleMenu::create(['role_id' => '6', 'menu_id' => '4']);
        RoleMenu::create(['role_id' => '6', 'menu_id' => '5']);
        RoleMenu::create(['role_id' => '6', 'menu_id' => '6']);
        RoleMenu::create(['role_id' => '6', 'menu_id' => '8']);
        RoleMenu::create(['role_id' => '6', 'menu_id' => '9']);
        RoleMenu::create(['role_id' => '6', 'menu_id' => '10']);
        RoleMenu::create(['role_id' => '6', 'menu_id' => '11']);
        RoleMenu::create(['role_id' => '6', 'menu_id' => '12']);
        RoleMenu::create(['role_id' => '6', 'menu_id' => '13']);
        RoleMenu::create(['role_id' => '6', 'menu_id' => '14']);

        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_menu');
    }
};
