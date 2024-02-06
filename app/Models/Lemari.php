<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lemari extends Model
{
    use HasFactory;

    protected $table = 'lemari';
    protected $fillable = ['id_lokasi', 'nama_lemari','deleted_at'];
    protected $primaryKey = 'id_lemari';

    public function lokasi() 
    {
        return $this->belongsTo(Lokasi::class,'id_lokasi', 'id_lokasi');
    }
}
