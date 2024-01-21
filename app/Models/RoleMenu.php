<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    use HasFactory;

    protected $table ='role_menu';
    protected $fillable = ['role_id', 'menu_id'];
    protected $primaryKey = 'id';
    
}
