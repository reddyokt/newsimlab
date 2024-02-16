<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table ='tugas';
    protected $fillable =[
                            'id_kelas',
                            'id_modulkelas',
                            'id_periode',
                            'uraian_tugas',
                            'status',
                            'file_tugas',
                            'jenis'
                        ];
    protected $primaryKey ='id_tugas';
    
    public function tgskls()
    {
        return $this->hasOne(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function tgsmdl()
    {
        return $this->hasOne(ModulKelas::class, 'id_modulkelas', 'id_modulkelas');
    }

    public function tgsnilaitugas()
    {
        return $this->hasMany(NilaiTugas::class,'id_tugas', 'id_tugas');
    }
}
