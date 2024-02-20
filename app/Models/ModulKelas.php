<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class ModulKelas extends Model
{
    use HasFactory;

    protected $table = 'modulkelas';
    protected $fillable = ['id_kelas',
                            'id_modul', 
                            'id_periode', 
                            'tanggal_praktek', 
                            'created_by', 
                            'isUsed', 
                            'updated_by', 
                            'deleted_at'
                        ];
    protected $primaryKey = 'id_modulkelas';

    public function moduls()
    {
        return $this->hasOne(ModulPraktikum::class, 'id_modul', 'id_modul');
    }

    public function kels()
    {
        return $this->hasOne(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function tgs()
    {
        return $this->hasMany(Tugas::class, 'id_modulkelas', 'id_modulkelas');
    }
          
    public function absmod()
    {
        return $this->hasMany(Absen::class, 'id_modulkelas', 'id_modulkelas');
    }

    public function getTanggal()
    {
        return Carbon::parse($this->attributes['tanggal_praktek'])
            ->translatedFormat('l, d F Y');
    }

    public function periode()
    {
        return $this->hasOne(Periode::class, 'id_periode', 'id_periode');
    }
}
