<?php

use App\Models\Majelis;
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
        Schema::create('majelis', function (Blueprint $table) {
            $table->id('id_majelis');
            $table->string('name');
            $table->string('code');
            $table->enum('type', ['Majelis','Lembaga']);
            $table->longText('description')->nullable();
            $table->enum('isActive', ['Yes', 'No'])->default('Yes');
            $table->timestamps();
        });
        Majelis::create(['name' => 'Tabligh','code' => 'TAB', 'type' => 'Majelis']);
        Majelis::create(['name' => 'Pendidikan Anak Usia Dini, Dasar dan Menengah','code' => 'PAUD', 'type' => 'Majelis']);
        Majelis::create(['name' => 'Kesehatan','code' => 'KES', 'type' => 'Majelis']);
        Majelis::create(['name' => 'Ekonomi dan Ketenagakerjaan','code' => 'EKO', 'type' => 'Majelis']);
        Majelis::create(['name' => 'Pembinaan Kader','code' => 'PKD', 'type' => 'Majelis']);
        Majelis::create(['name' => 'Kesejahteraan Sosial','code' => 'SOS', 'type' => 'Majelis']);
        Majelis::create(['name' => 'Pendidikan Tinggi','code' => 'PT', 'type' => 'Majelis']);
        Majelis::create(['name' => 'Budaya, Seni, dan Olahraga','code' => 'BSO', 'type' => 'Lembaga']);
        Majelis::create(['name' => 'Penelitian dan Pengembangan Aisyiyah','code' => 'LPPA', 'type' => 'Lembaga']);
        Majelis::create(['name' => 'Hukum dan HAM','code' => 'HHAM', 'type' => 'Majelis']);
        Majelis::create(['name' => 'Lingkungan Hidup dan Penanggulangan Bencana','code' => 'LHPB', 'type' => 'Lembaga']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('majelis');
    }
};
