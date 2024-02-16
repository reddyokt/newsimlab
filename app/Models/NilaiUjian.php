<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiUjian extends Model
{
    use HasFactory;

    protected $table = 'nilai_ujian';
    protected $fillable = ['id_kelas',
                            'id_ujian',
                            'id_periode',
                            'id_mahasiswa_kelas',
                            'jenis',
                            'uraian_jawaban',
                            'file_jawaban',
                            'nilai'
                            ];
    protected $primaryKey = 'id_nilai_ujian';

    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'id_ujian', 'id_ujian');
    }

    
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
