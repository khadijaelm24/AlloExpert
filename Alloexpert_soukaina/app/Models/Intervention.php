<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    //declaration du nom de la table
    protected $table = 'intervention';

    //declaration des colonnes
    protected $fillable = [
        'prix',
        'type_intervention',
        'date_depart',
        'date_arrivee',
        'duree',
        'id_par',
    ];

    // Indiquer que les colonnes peuvent être nulles
    protected $nullable = [
    ];

    protected $dates = ['created_at', 'updated_at'];
}