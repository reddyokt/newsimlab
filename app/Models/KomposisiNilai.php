<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomposisiNilai extends Model
{
    use HasFactory;

    protected $table = 'komposisi_nilai';
    protected $fillable = ['nama_komponen', 'nilai_komponen', 'created_by', 'updated_by', 'deleted_at'];
    protected $primaryKey = 'id_komponen';

}
