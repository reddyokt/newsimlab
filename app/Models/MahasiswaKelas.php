<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class MahasiswaKelas extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_kelas';
    protected $fillable = ['id_mahasiswa','id_kelas', 'id_kelompok'];
    protected $primaryKey = 'id_mahasiswa_kelas';
    

    public function mhs()
    {
        return $this->belongsTo(Mahasiswa::class,'id_mahasiswa', 'id_mahasiswa');
    }
}
