<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulReport extends Model
{
    use HasFactory;

    protected $table = 'modul_report';
    protected $fillable = ['id_modulkelas', 
                            'id_kelas', 
                            'id_periode', 
                            'uraian_report', 
                            'image_report', 
                            'created_by', 
                            'updated_by', 
                            'deleted_at'
                          ];
    protected $primaryKey = 'id_modul_report';
}
