<?php

use App\Models\Pda;
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
        Schema::create('pda', function (Blueprint $table) {
            $table->id('pda_id');
            $table->char('regencies_id', 4)->index();
            $table->foreign('regencies_id')->references('id')->on('regencies')->onDelete('cascade');
            $table->string('pda_name');
            $table->longText('address')->nullable();
            $table->string('created_by');
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
        Pda::create(['pda_name' => 'KEPULAUAN SERIBU','regencies_id' => '3101', 'created_by' => 'admin']);
        Pda::create(['pda_name' => 'JAKARTA SELATAN','regencies_id' => '3171', 'created_by' => 'admin']);
        Pda::create(['pda_name' => 'JAKARTA TIMUR','regencies_id' => '3172', 'created_by' => 'admin']);
        Pda::create(['pda_name' => 'JAKARTA PUSAT','regencies_id' => '3173', 'created_by' => 'admin']);
        Pda::create(['pda_name' => 'JAKARTA BARAT','regencies_id' => '3174', 'created_by' => 'admin']);
        Pda::create(['pda_name' => 'JAKARTA UTARA','regencies_id' => '3175', 'created_by' => 'admin']);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pda');
    }
};
