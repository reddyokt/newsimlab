<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'document';
    protected $fillable = ['id_filetype', 'pda_id', 'pca_id', 'docname', 'uploaded_doc', 'deleted_at'];
}
