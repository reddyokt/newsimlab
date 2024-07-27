<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAlat extends Model
{
    use HasFactory;

    protected $table = 'detail_alat';
    protected $fillable = ['id_alat', 'sub_id_alat','condition','description','created_by', 'updated_by',
                            'deleted_at','deadline_calibration', 'last_calibration_at'];
    protected $primaryKey = 'id_detail_alat';
}
