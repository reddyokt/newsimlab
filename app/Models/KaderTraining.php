<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaderTraining extends Model
{
    use HasFactory;
    protected $table = 'training_kader';
    protected $fillable = [
                            'kader_id','trainingtype',
                            'trainingname'
                          ];

    protected $primaryKey = 'id_training';

}
