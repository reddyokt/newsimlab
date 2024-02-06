<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table ='tugas';
    protected $fillable =[
                            'id_kelas',
                            'id_modulkelas',
                            'id_periode',
                            'uraian_tugas',
                            'status',
                            'file_tugas',
                            'jenis'
                        ];
    protected $primaryKey ='id_tugas';
}
