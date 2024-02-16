<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSubjektif extends Model
{
    use HasFactory;

    protected $table = 'nilai_subjektif';
    protected $fillable = [
                            'id_modulkelas',
                            'id_periode',
                            'id_mahasiswa_kelas',
                            'uraian',
                            'nilai',
                            'id_kelas'
                        ];
    protected $primaryKey = "id_nilai_subjektif";

    public function modulkelas()
    {
        return $this->hasOne(ModulKelas::class,'id_modulkelas','id_modulkelas');
    }
}
