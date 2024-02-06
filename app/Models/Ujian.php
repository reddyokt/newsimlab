<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'ujian';
    protected $fillable = ['id_kelas','id_periode','jenis','uraian_ujian','file_ujian','status'];
    protected $primaryKey = 'id_ujian';

}
