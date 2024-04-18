<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    //declaration du nom de la table
    protected $table = 'commentaire';

    //declaration des colonnes
    protected $fillable = [
        'contenu',
        'note',
        'date_cmt',
        'id_clt',
        'id_par',
    ];

    // Indiquer que les colonnes peuvent être nulles
    protected $nullable = [
    ];

    protected $dates = ['created_at', 'updated_at'];
}