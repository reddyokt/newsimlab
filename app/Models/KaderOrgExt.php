<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaderOrgExt extends Model
{
    use HasFactory;
    protected $table = 'orgext_kader';
    protected $fillable = [
                            'kader_id','orgextname',
                            'orgextjabatan', 'orgextstart',
                            'orgextend'
                          ];

    protected $primaryKey = 'id_orgext';
}
