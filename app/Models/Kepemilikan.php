<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepemilikan extends Model
{
    use HasFactory;

    protected $table ='kepemilikan';
    protected $fillable = ['name','deleted_at'];
    protected $primaryKey = 'id_kepemilikan';
}
