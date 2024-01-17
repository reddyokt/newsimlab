<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    protected $table = 'newscategory';
    protected $fillable = ['category', 'isActive', 'deleted_at'];
    protected $primaryKey = 'id_category';
}
