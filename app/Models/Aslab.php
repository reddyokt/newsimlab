<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aslab extends Model
{
    use HasFactory;

    protected $table = 'aslab';
    protected $primaryKey = 'id_aslab';
    protected $fillable = ['nim',
                            'nama',
                            'photo',
                            'status',
                            'deleted_at',
                            'user_id'
                          ];
    public function userAslab()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
