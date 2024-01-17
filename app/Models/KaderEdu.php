<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaderEdu extends Model
{
    use HasFactory;
    protected $table = 'edu_kader';
    protected $fillable = [
                            'kader_id','jenjang',
                            'eduyear'
                          ];

    protected $primaryKey = 'id_edu';
}
