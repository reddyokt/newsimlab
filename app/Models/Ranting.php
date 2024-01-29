<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranting extends Model
{
    use HasFactory;

    protected $primaryKey = 'ranting_id';
    protected $table = 'ranting';
    protected $fillable = ['ranting_name','pda_id','pca_id','villages_id','address','deleted_at'];

}
