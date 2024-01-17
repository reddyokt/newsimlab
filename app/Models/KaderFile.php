<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaderFile extends Model
{
    use HasFactory;
    protected $table = 'kader_file';
    protected $fillable = [
                            'kader_id','filepp',
                            'filenbma', 'deleted_at'
                          ];

    protected $primaryKey = 'id_kader_file';
}
