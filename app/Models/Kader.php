<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    use HasFactory;

    protected $table = 'kader_info';
    protected $fillable = [ 'kader_name','kader_phone',
                            'kader_email','gender',
                            'marital','address',
                            'nba','nbm',
                            'ranting_id','status',
                            'deleted_at'
                            ];
    protected $primaryKey = 'kader_id';
}
