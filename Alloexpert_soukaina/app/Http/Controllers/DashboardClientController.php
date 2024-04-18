<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardClientController extends Controller
{
    // Afficher le tableau de bord Client
    public function dashboardclient(){

        // Accéder aux variables de session
        $user_cl = Session::get('user_cl');
        $id_cl = Session::get('id_cl');
        $nom_cl = Session::get('nom_cl');
        $prenom_cl = Session::get('prenom_cl');
        $photo_cl = Session::get('photo_cl');
        $password_cl = Session::get('password_cl');
        $adresse_cl = Session::get('adresse_cl');
        $email_cl = Session::get('email_cl');
        $telephone_cl = Session::get('telephone_cl');
        $id_admin_cl = Session::get('id_admin_cl');

        return view('client.dash');
    }

    // Se deconnecter
    public function logout(){

        // Détruire les variables de session
        Session::forget('user_cl');
        Session::forget('id_cl');
        Session::forget('nom_cl');
        Session::forget('prenom_cl');
        Session::forget('photo_cl');
        Session::forget('password_cl');
        Session::forget('adresse_cl');
        Session::forget('email_cl');
        Session::forget('telephone_cl');
        Session::forget('id_admin_cl');
        
        return redirect()->route('login');
    }


}
