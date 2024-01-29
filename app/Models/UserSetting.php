<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $table = 'user_setting';
    protected $fillable = ['user_id', 'default_setting', 'created_by'];
    protected $primaryKey = 'id';
}
