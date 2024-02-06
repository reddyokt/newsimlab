<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $table = 'periode';
    protected $fillable = ['start','end', 'tahun_ajaran','semester', 'isActive', 'deleted_at'];
    protected $primaryKey = 'id_periode';

}
