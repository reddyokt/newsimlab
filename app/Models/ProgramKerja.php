<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    use HasFactory;

    protected $table = 'proker';
    protected $fillable = ['id_periode', 'proker_name', 'prokerstart',
                            'prokerend', 'status', 'anggaran',
                            'created_by', 'pda_id', 'updated_by', 'description'];
    protected $primaryKey = 'id_proker';
}
