<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardPartenaireController extends Controller
{
    // Afficher le tableau de bord partenaire
    public function dashboardpartenaire(){

        // Accéder aux variables de session
        $user_par = Session::get('user_par');
        $id_par = Session::get('id_par');
        $nom_par = Session::get('nom_par');
        $prenom_par = Session::get('prenom_par');
        $password_par = Session::get('password_par');
        $ville_par = Session::get('ville_par');
        $email_par = Session::get('email_par');
        $photo_par = Session::get('photo_par');
        $metier_par = Session::get('metier_par');
        $nbr_experience_par = Session::put('nbr_experience_par');
        $domaine_expertise_par = Session::put('domaine_expertise_par');
        $id_admin_par = Session::put('id_admin_par');

        return view('partenaire.dashboard_partenaire');
    }

    // Se deconnecter
    public function logout(){

        // Détruire les variables de session
        Session::forget('user_par');
        Session::forget('id_par');
        Session::forget('nom_par');
        Session::forget('prenom_par');
        Session::forget('password_par');
        Session::forget('ville_par');
        Session::forget('email_par');
        Session::forget('photo_par');
        Session::forget('metier_par');
        Session::forget('nbr_experience_par');
        Session::forget('domaine_expertise_par');
        Session::forget('id_admin_par');
        
        return redirect()->route('login');
    }
}
