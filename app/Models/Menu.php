<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $fillable = ['name','code','tipe_menu', 'created_by', 'updated_by', 'deleted_at'];
    protected $primaryKey = 'menu_id';

}
