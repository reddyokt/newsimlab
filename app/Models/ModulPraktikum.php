<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulPraktikum extends Model
{
    use HasFactory;

    protected $table='modul';
    protected $fillable=['id_matkul','modul_name','created_by'];
    protected $primaryKey='id_modul';

    public function alat()
    {
        return $this->hasMany(ModulAlat::class, 'id_modul', 'id_modul');
    }

    public function bahan()
    {
        return $this->hasMany(ModulBahan::class, 'id_modul', 'id_modul');
    }

    public function matkul()
    {
        return $this->hasOne(Matkul::class, 'id_matkul', 'id_matkul');
    }

    public function modulkls()
    {
        return $this->hasOne(ModulKelas::class, 'id_modul', 'id_modul');
    }
}
