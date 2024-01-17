<?php

use App\Models\Kepemilikan;
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
        Schema::create('kepemilikan', function (Blueprint $table) {
            $table->id('id_kepemilikan');
            $table->string('name');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
        Kepemilikan::create(['name' => 'Aisyiyah']);
        Kepemilikan::create(['name' => 'Sewa']);
        Kepemilikan::create(['name' => 'Negara']);       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepemilikan');
    }
};
