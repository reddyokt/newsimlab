<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $table = 'matkul';
    protected $primaryKey = 'id_matkul';

    public function modul()
    {
        return $this->hasMany(ModulPraktikum::class, 'id_matkul', 'id_matkul');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_matkul', 'id_matkul');
    }

}
