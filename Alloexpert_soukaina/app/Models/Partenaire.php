<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    //declaration du nom de la table
    protected $table = 'partenaire';

    //declaration des colonnes
    protected $fillable = [
        'nom_par',
        'prenom_par',
        'password',
        'ville',
        'email',
        'metier',
        'nbr_experience',
        'creneau_dispo',
        'domaine_expertise',
    ];

    // Indiquer que les colonnes peuvent être nulles
    protected $nullable = [
        'photo_par',
        'id_admin',
    ];

    protected $dates = ['created_at', 'updated_at'];
}