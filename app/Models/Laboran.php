<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboran extends Model
{
    use HasFactory;

    protected $table = 'laboran';
    protected $primaryKey = 'id_laboran';
    protected $fillable = ['user_id', 'nip', 'nama_laboran', 'status', 'created_by', 'deleted_at'];
}
