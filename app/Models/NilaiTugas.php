<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiTugas extends Model
{
    use HasFactory;

    protected $table = 'nilai_tugas';
    protected $fillable = ['id_tugas',
                            'id_modulkelas',
                            'id_periode',
                            'id_mahasiswa_kelas',
                            'jenis',
                            'uraian_jawaban',
                            'file_jawaban',
                            'nilai',
                            'id_kelas'
                        ];

    protected $primaryKey = 'id_nilai_tugas';

    public function nilaix()
    {
        return $this->hasMany(MahasiswaKelas::class,'id_mahasiswa_kelas','id_mahasiswa_kelas');
    }

    public function tgsnilai()
    {
        return $this->hasOne(Tugas::class, 'id_tugas', 'id_tugas');
    }
}
