<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    protected $fillable = ['id_category','news_title','slug','news_body','feature_image'
                            ,'images','status','deleted_at', 'created_by', 'updated_by'];
    protected $primaryKey = 'news_id';
}
