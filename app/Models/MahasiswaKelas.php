<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MahasiswaKelas extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_kelas';
    protected $fillable = ['id_mahasiswa','id_kelas', 'id_kelompok'];
    protected $primaryKey = 'id_mahasiswa_kelas';
    

    public function mhs()
    {
        return $this->hasOne(Mahasiswa::class,'id_mahasiswa', 'id_mahasiswa');
    }

    public function mhskel()
    {
        return $this->belongsTo(Kelompok::class, 'id_kelompok', 'id_kelompok');
    }

    public function mhskls()
    {
        return $this->hasOne(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function maskel()
{
    return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas')->with('matkul');
}

    public function nilaitugasmhs()
    {
        return $this->hasOne(NilaiTugas::class, 'id_mahasiswa_kelas' ,'id_mahasiswa_kelas');
    }

    public function nilaiujianmhs()
    {
        return $this->hasOne(NilaiUjian::class, 'id_mahasiswa_kelas' ,'id_mahasiswa_kelas');
    }

    public function absensimhs()
    {
        return $this->hasMany(Absen::class, 'id_mahasiswa_kelas' ,'id_mahasiswa_kelas');
    }
}
