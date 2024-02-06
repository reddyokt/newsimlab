<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanPraktikum extends Model
{
    use HasFactory;

    protected $table = 'bahan';
    protected $fillable = [
                            'id_lemari',
                            'nama_bahan',
                            'rumus',
                            'jumlah',
                            'images',
                            'created_by',
                            'deleted_at'
                            ];
protected $primaryKey = 'id_bahan';
}
