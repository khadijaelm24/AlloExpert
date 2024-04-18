<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Declaration of the table name
    protected $table = 'reservation';

    // Declaration of the columns
    protected $fillable = [
        'status',
        'service',
        'date_reservation',
        'heure', // Add heure field
        'partenaire_nom', // Add partenaire_nom field
        'partenaire_prenom', // Add partenaire_prenom field
        'id_clt',
    ];

    // Indicate that the columns can be nullable
    protected $nullable = [];

    protected $dates = ['created_at', 'updated_at'];
}
