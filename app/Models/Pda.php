<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pda extends Model
{
    use HasFactory;

    protected $table = 'pda';
    protected $fillable = ['pda_name', 'regencies_id', 'created_by', 'address'];
    protected $primaryKey = 'pda_id';
}
