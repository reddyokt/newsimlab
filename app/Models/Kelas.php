<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = [
                            'id_periode',
                            'id_matkul',
                            'kode_matkul',
                            'nama_kelas',
                            'id_dosen',
                            'id_aslab',
                            'status',
                            'jumlah_pertemuan',
                            'deleted_at'
                                    ];
    protected $primaryKey = 'id_kelas';

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
    }
    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'id_dosen', 'id_dosen');
    }
    public function aslab()
    {
        return $this->belongsTo(Aslab::class, 'id_aslab', 'id_aslab');
    }

    public function periode()
    {
        return $this->hasOne(Periode::class, 'id_periode', 'id_periode');
    }

    public function kelompok()
    {
        return $this->hasMany(Kelompok::class, 'id_kelas', 'id_kelas');
    }

    public function mhskelas()
    {
        return $this->hasMany(MahasiswaKelas::class, 'id_kelas', 'id_kelas');
    }

    public function modulkelas()
    {
        return $this->hasMany(ModulKelas::class, 'id_kelas', 'id_kelas');
    }

    public function modultugas()
    {
        return $this->hasMany(Tugas::class, 'id_kelas', 'id_kelas');
    }

    public function ujian()
    {
        return $this->hasMany(Ujian::class, 'id_kelas', 'id_kelas');
    }

    public function absen()
    {
        return $this->hasMany(Absen::class, 'id_kelas', 'id_kelas');
    }

    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class, 'id_kelas', 'id_kelas');
    }
}
