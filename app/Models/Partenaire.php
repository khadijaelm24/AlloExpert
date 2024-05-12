<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    protected $table = 'partenaire';
    protected $fillable = [
        'nom_par', 'prenom_par', 'password', 'ville', 'email', 'photo_par',
        'nbr_experience', 'domaine_expertise', 'connexion','is_active',
    ];

    public function services() {
        return $this->hasMany(Service::class, 'id_expert');
    }

    // Calculer la moyenne des notes pour le partenaire
    public function averageRating() {
        $services = $this->services()->with('reservation.commentaireExpert')->get();

        $totalNotes = 0;
        $countNotes = 0;

        foreach ($services as $service) {
            foreach ($service->reservation as $reserv) {
                if ($reserv->commentaireExpert) {
                    $totalNotes += $reserv->commentaireExpert->note;
                    $countNotes++;
                }
            }
        }

        return $countNotes > 0 ? round($totalNotes / $countNotes, 2) : 'No ratings yet';
    }
}
