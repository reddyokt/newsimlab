<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi';
    protected $fillable = ['nama_lokasi', 'deleted_at'];
    protected $primaryKey = 'id_lokasi';

    public function lemari() 
    {
        return $this->hasMany(Lemari::class,'id_lokasi', 'id_lokasi');
    }
}
