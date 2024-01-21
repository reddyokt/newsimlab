<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProkerDetail extends Model
{
    use HasFactory;

    protected $table = 'prokerdetail';
    protected $fillable = ['id_proker', 'note_update' , 'proker_image', 'created_by'];
    protected $primaryKey = 'id_prokerdetail';
}
