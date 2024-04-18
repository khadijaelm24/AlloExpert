<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller{

    public function register(){
        return view('register');
    }

    public function registerPost(Request $request){

        // Vérifier si l'email existe déjà dans la base de données
        $emailExistsClient = Client::where('email', $request->email)->exists() || Partenaire::where('email', $request->email)->exists();
        $emailExistsPartenaire = Partenaire::where('email', $request->email)->exists() || Partenaire::where('email', $request->email)->exists();

        if($emailExistsClient || $emailExistsPartenaire) {
            return back()->with('errorRegister', 'Cet email est déjà utilisé, veuillez en choisir un autre');
        }

        // Continuer le processus d'inscription si l'email n'existe pas déjà
        if($request->user_type == 'client'){
            //sign up cas client

            $client = new Client();
            $client->nom_cl = $request->nom_cl;
            $client->prenom_cl = $request->prenom_cl;

            $filename = '';

            if($request->hasFile('photo_cl')){
                $imgcl = $request->file('photo_cl');
                $filename = $imgcl->getClientOriginalName();
                $imgcl->move('uploads/client',$filename);
            }

            $client->photo_cl = $filename;

            $client->adresse = $request->adresse;
            $client->telephone = $request->telephone;
            $client->email = $request->email;
            $client->password = Hash::make($request->password);
            $client->save();
            return back()->with('successRegisterClient', 'Votre compte Client a bien été créé');

        } elseif ($request->user_type == 'partner') {
            // sign up cas partenaire

            $partenaire = new Partenaire();
            $partenaire->nom_par = $request->nom_par;
            $partenaire->prenom_par = $request->prenom_par;

            $filename = '';

            if($request->hasFile('photo_par')){
                $imgcl = $request->file('photo_par');
                $filename = $imgcl->getClientOriginalName();
                $imgcl->move('uploads/partenaire',$filename);
            }

            $partenaire->photo_par = $filename;

            $partenaire->ville = $request->ville;
            $partenaire->metier = $request->metier;
            $partenaire->nbr_experience = $request->nbr_experience;
            $partenaire->domaine_expertise = implode(', ', $request->domaine_expertise);//modifier
            $partenaire->email = $request->email;
            $partenaire->password = Hash::make($request->password);
            $partenaire->save();
            return back()->with('successRegisterPartenaire', 'Votre compte Partenaire a bien été créé');

        } else {
            // Gérer le cas où aucun type d'utilisateur n'est sélectionné
            return back()->with('errorRegister', 'Veuillez choisir un type d\'utilisateur valide');
        }

    }

}
