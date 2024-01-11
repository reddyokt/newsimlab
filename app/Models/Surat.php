<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';
    protected $fillable = ['kepada_id', 'subject', 'body', 'file_uploaded', 'created_by', 'deleted_at'];
    protected $primaryKey = 'id_surat';
}
