<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatPraktikum extends Model
{
    use HasFactory;

    protected $table = 'alat';
    protected $fillable = [
                            'jenis',
                            'id_lemari',
                            'nama_alat',
                            'merk_alat',
                            'ukuran_alat',
                            'jumlah',
                            'baris',
                            'kolom',
                            'images',
                            'created_by',
                            'deleted_at'
                            ];
    protected $primaryKey = 'id_alat';
}
