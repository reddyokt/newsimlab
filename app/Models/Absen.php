<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absen';
    protected $fillable = ['id_mahasiswa_kelas',
                            'id_modulkelas',
                            'id_kelas',
                            'id_periode',
                            'isAbsen',
                            'created_by',
                            'updated_by'
                            ];
    protected $primaryKey = 'id_absen';

    public function modulabsen()
    {
    return $this->hasMany(ModulKelas::class, 'id_modulkelas', 'id_modulkelas');
    }

    public function klsabsn()
    {
        return $this->hasOne(Kelas::class,'id_kelas','id_kelas');
    }

    public function absenperiode() 
    {
        return $this->hasOne(Periode::class, 'id_periode', 'id_periode');    
    }

    public function absenmhs()
    {
        return $this->hasMany(MahasiswaKelas::class,'id_mahasiswa_kelas', 'id_mahasiswa_kelas');
    }
}
