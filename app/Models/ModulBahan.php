<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulBahan extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table='modulbahan';
    protected $fillable=['id_modul','id_bahan','jumlah'];
    protected $primaryKey='id_modulbahan';

    public function bahans()
    {
        return $this->hasOne(BahanPraktikum::class, 'id_bahan', 'id_bahan');
    }
}
