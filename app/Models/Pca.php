<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PCA extends Model
{
    use HasFactory;

    protected $table = 'pca';
    protected $fillable = ['pca_name','district_id','address','pda_id','created_by'];
    protected $primaryKey = 'pca_id';
}
