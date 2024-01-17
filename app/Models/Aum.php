<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aum extends Model
{
    use HasFactory;

    protected $table = 'aum';
    protected $fillable = ['ranting_id',
                           'pca_id',
                           'pda_id',
                           'id_kepemilikan',
                           'id_bidangusaha',
                           'aum_name',
                           'address',
                           'isActive',
                           'deleted_at'];
    protected $primaryKey = 'id_aum';
}
