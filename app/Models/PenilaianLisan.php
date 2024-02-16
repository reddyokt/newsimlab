<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianLisan extends Model
{
    use HasFactory;

    protected $table = 'nilai_lisan';
    protected $fillable = ['id_kelas',
                            'id_ujian',
                            'id_periode',
                            'id_mahasiswa_kelas',
                            'nilai_lisan'
                            ];
    protected $primaryKey = 'id_nilai_lisan';
    
}
