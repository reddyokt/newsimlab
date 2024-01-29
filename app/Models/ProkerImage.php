<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProkerImage extends Model
{
    use HasFactory;

    protected $table = 'proker_image';
    protected $fillable = ['id_proker','images_proker','created_by'];
    protected $primaryKey = 'id_proker_image';
}
