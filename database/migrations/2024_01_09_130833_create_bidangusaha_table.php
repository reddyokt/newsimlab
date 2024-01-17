<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\BidangUsaha;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bidangusaha', function (Blueprint $table) {
            $table->id('id_bidangusaha');
            $table->string('name');
            $table->enum('isActive', ['Yes','No'])->default('Yes');
            $table->longText('description')->nullable();
            $table->timestamps();
        });
        Bidangusaha::create(['name' =>'Administrasi Pemerintahan, Pertahanan Dan Jaminan Sosial Wajib']);
        BidangUsaha::create(['name' =>'Aktivitas Badan Internasional Dan Badan Ekstra Internasional Lainnya']);
        BidangUsaha::create(['name' =>'Aktivitas Jasa Lainnya']);
        BidangUsaha::create(['name' =>'Aktivitas Kesehatan Manusia Dan Aktivitas Sosial']);
        BidangUsaha::create(['name' =>'Aktivitas Keuangan dan Asuransi']);
        BidangUsaha::create(['name' =>'Aktivitas Penyewaan dan Sewa Guna Usaha Tanpa Hak Opsi, Ketenagakerjaan, Agen Perjalanan dan Penunjang Usaha Lainnya']);
        BidangUsaha::create(['name' =>'Aktivitas Profesional, Ilmiah Dan Teknis']);
        BidangUsaha::create(['name' =>'Aktivitas Rumah Tangga Sebagai Pemberi Kerja; Aktivitas Yang Menghasilkan Barang Dan Jasa Oleh Rumah Tangga yang Digunakan untuk Memenuhi Kebutuhan Sendiri']);
        BidangUsaha::create(['name' =>'Industri Pengolahan']);
        BidangUsaha::create(['name' =>'Informasi Dan Komunikasi']);
        BidangUsaha::create(['name' =>'Kesenian, Hiburan Dan Rekreasi']);
        BidangUsaha::create(['name' =>'Konstruksi']);
        BidangUsaha::create(['name' =>'Pendidikan']);
        BidangUsaha::create(['name' =>'Pengadaan Listrik, Gas, Uap/Air Panas Dan Udara Dingin']);
        BidangUsaha::create(['name' =>'Pengangkutan dan Pergudangan']);
        BidangUsaha::create(['name' =>'Penyediaan Akomodasi Dan Penyediaan Makan Minum']);
        BidangUsaha::create(['name' =>'Perdagangan Besar Dan Eceran; Reparasi Dan Perawatan Mobil Dan Sepeda Motor']);
        BidangUsaha::create(['name' =>'Pertambangan dan Penggalian']);
        BidangUsaha::create(['name' =>'Pertanian, Kehutanan dan Perikanan']);
        BidangUsaha::create(['name' =>'Real Estat']);
        BidangUsaha::create(['name' =>'Treatment Air, Treatment Air Limbah, Treatment dan Pemulihan Material Sampah, dan Aktivitas Remediasi']);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidangusaha');
    }
};
