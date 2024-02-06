<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';
    protected $fillable =['nidn','nama_dosen','isActive'];

    public function userDosen()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
