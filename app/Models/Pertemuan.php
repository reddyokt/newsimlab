<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;

    protected $table = 'pertemuan';
    protected $primaryKey = 'id_pertemuan';
    protected $fillable = [
                            'id_kelas',
                            'id_periode',
                            'nama_pertemuan',
                            'tanggal',
                            'notes',
                            'created_by',
                            'deleted_at'
                            ];

    
}
