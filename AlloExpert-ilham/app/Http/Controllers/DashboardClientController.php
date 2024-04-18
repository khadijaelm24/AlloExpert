<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;

class DashboardClientController extends Controller
{
    // Afficher le tableau de bord Client
    public function dashboardclient()
    {
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

        return view('client.dashboard_client');
    }

    // Se déconnecter
    public function logout()
    {
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

    // Vue du profil
    public function ProfileForm()
    {
        $client = auth()->user(); // Récupérer le client connecté

        return view('profile', compact('client'));
    }

    // Modifier le profil
    public function editProfile()
    {
        return view('edit_profile');
    }

    // Mettre à jour le profil
    public function updateProfile(Request $request)
    {
    
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'nom_cl' => 'required|string|max:255',
            'prenom_cl' => 'required|string|max:255',
            'email_cl' => 'required|string|max:255',
            'adresse_cl' => 'required|string|max:255',
            'telephone_cl' => 'required|string|max:10'
        ]);

        // Récupérer l'ID du client connecté
        $clientId = Session::get('id_cl');

         //Mettre à jour les informations du client dans la base de données
        $filename = '';

        if ($request->hasFile('photo_cl')) {
            $imgcl = $request->file('photo_cl');
            $filename = $imgcl->getClientOriginalName();
            $imgcl->move('uploads/client', $filename);
        }
       $filename=$request->photo_cl;
        $affectedRows = Client::where('id', $clientId)->update([
            'photo_cl' =>$request->photo_cl,
            'nom_cl' => $request->nom_cl,
            'prenom_cl' => $request->prenom_cl,
            'email' => $request->email_cl,
            'adresse' => $request->adresse_cl,
            'telephone' => $request->telephone_cl,
            'password' => Hash::make($request->password)
        ]);

        // Vérifier si des lignes ont été affectées (mise à jour réussie)
        if ($affectedRows > 0) {
            // Rediriger l'utilisateur vers la page de profil après la mise à jour
                // Mettre à jour les informations du profil dans la session
              //  Session::put('photo_cl', $request->photo_cl);

                
               Session::put('nom_cl', $request->nom_cl);
                // Mettez à jour d'autres champs de profil de la même manière
              Session::put('prenom_cl', $request->prenom_cl);
              Session::put('email_cl', $request->email_cl);
              Session::put('adresse_cl', $request->adresse_cl);
              Session::put('telephone_cl', $request->telephone_cl);
            return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès !');
        } else {
            // En cas d'échec de la mise à jour, rediriger avec un message d'erreur
            return redirect()->route('profile')->with('error', 'La mise à jour du profil a échoué.');
        }
    }
}

/*
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
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

        return view('uploads\client.dashboard_client');
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
    //view_profile
    public function ProfileForm()
{
    $client = auth()->user(); // Récupérer le client connecté
    if (!$client) {
        // Gérer le cas où l'utilisateur n'est pas authentifié, par exemple, rediriger vers la page de connexion
        return redirect()->route('login');
    }

    return view('profile', compact('client'));
}
//edit_profile
public function editProfile()
{
    return view('edit_profile');
}
//update_profile
public function updateProfile(Request $request)
{
    /* Récupérer le client connecté
    $client = auth()->user();

    // Mettre à jour les informations du client dans la base de données
    $client->nom_cl = $request->nom_cl;
    $client->prenom_cl = $request->prenom_cl;
    $client->email_cl = $request->email_cl;
    $client->adresse_cl = $request->adresse_cl;
    $client->telephone_cl = $request->telephone_cl;

    // Sauvegarder les modifications dans la base de données en utilisant le modèle Client
    $client->save();
    
    // Rediriger l'utilisateur vers la page de profil après la mise à jour
    return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès !');
     //Valider les données du formulaire
    $validatedData = $request->validate([
        'nom_cl' => 'required|string|max:255',
        'prenom_cl'=>'required|string|max:255',
        'email_cl'=>'required|string|max:255',
        'adresse_cl'=>'required|string|max:255',
        'telephone_cl'=>'required|string|max:10'
    ]);

    // Récupérer l'ID du client connecté
    $clientId = Session::get('id_cl');       

    // Mettre à jour les informations du client dans la base de données
    $affectedRows = Client::where('id', $clientId)->update([
        'nom_cl' => $request->nom_cl,
        'prenom_cl' => $request->prenom_cl,
        'email_cl' => $request->email_cl,
        'adresse_cl' => $request->adresse_cl,
        'telephone_cl' => $request->telephone_cl,
    ]);

    // Vérifier si des lignes ont été affectées (mise à jour réussie)
    if ($affectedRows > 0) {
        // Rediriger l'utilisateur vers la page de profil après la mise à jour
        return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès !');
    } else {
        // En cas d'échec de la mise à jour, rediriger avec un message d'erreur
        return redirect()->route('profile')->with('error', 'La mise à jour du profil a échoué.');
    }

}

/********************************************************************************************************** */
     /* Récupérer le client connecté
    $client = auth()->user();
    $client = new Client();
    // Mettre à jour les informations du profil dans la session
    $client->nom_cl = Session::put('nom_cl', $request->nom_cl);
    // Mettez à jour d'autres champs de profil de la même manière
    $client->prenom_cl =Session::put('prenom_cl', $request->prenom_cl);
    $client->email =Session::put('email_cl', $request->email_cl);
    $client->adresse =Session::put('adresse_cl', $request->adresse_cl);
    $client->telephone =Session::put('telephone_cl', $request->telephone_cl);
    $client->password = Session::put('telephone_cl', $request->telephone_cl);

  
   $client->save();
    // Rediriger l'utilisateur vers la page de profil après la mise à jour
    return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès !');*/
   /* Mettre à jour les informations du client dans la base de données
   $client->nom_cl = $request->nom_cl;
   // Mettez à jour d'autres champs de profil de la même manière
   $client->prenom_cl = $request->prenom_cl;
   $client->email_cl = $request->email_cl;
   $client->adresse_cl = $request->adresse_cl;
   $client->telephone_cl = $request->telephone_cl;

    // Vérifiez s'il y a une nouvelle photo de profil téléchargée
    if ($request->hasFile('photo_cl')) {
        // Obtenez le fichier téléchargé
        $photo = $request->file('photo_cl');
        // Générez un nom unique pour la photo
        $fileName = time().'.'.$photo->getClientOriginalExtension();
        // Déplacez le fichier téléchargé vers le dossier de destination
        $photo->move(public_path('uploads/client'), $fileName);
        // Mettez à jour la session avec le nouveau nom de fichier de la photo de profil
        Session::put('photo_cl', $fileName);
    }
    $client->save();

}*/



