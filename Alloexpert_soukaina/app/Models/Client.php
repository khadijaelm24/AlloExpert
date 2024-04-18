<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    //declaration du nom de la table
    protected $table = 'client';

    //declaration des colonnes
    protected $fillable = [
        'nom_cl',
        'prenom_cl',
        'password',
        'adresse',
        'email',
    ];

    // Indiquer que les colonnes peuvent être nulles
    protected $nullable = [
        'photo_cl',
        'id_admin',
    ];

    protected $dates = ['created_at', 'updated_at'];
}