<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;
    
    protected $table = 'kelompok';
    protected $fillable = ['nama_kelompok','id_kelas', 'deleted_at'];
    protected $primaryKey = 'id_kelompok';


    public function mhskelas()
    {
        return $this->hasMany(MahasiswaKelas::class, 'id_kelompok', 'id_kelompok');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
