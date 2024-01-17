<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaderOrgInt extends Model
{
    use HasFactory;
    protected $table = 'orgint_kader';
    protected $fillable = [
                            'kader_id','orggrade',
                            'orgintjabatan', 'orgintstart',
                            'orgintend'
                          ];

    protected $primaryKey = 'id_orgint';
}
