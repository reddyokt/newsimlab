<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulAlat extends Model
{
    use HasFactory;
    protected $table='modulalat';
    protected $fillable=['id_modul','id_alat','jumlah'];
    protected $primaryKey='id_modulalat';


    public function modulalat()
    {
        return $this->belongsTo(ModulPraktikum::class, 'id_modul', 'id_modul');
    }

    public function alats()
    {
        return $this->belongsTo(AlatPraktikum::class, 'id_alat', 'id_alat');
    }
}
