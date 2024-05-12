<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Service;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Partenaire;
use App\Models\CommentaireClient;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class DashboardClientController extends Controller
{
    // Afficher le tableau de bord Client
    public function dashboardclient(){
        $today = now()->startOfDay();
        $twoDaysAgo = $today->copy()->subDays(2);
        // Using transactions to ensure data integrity
        DB::transaction(function () use ($today, $twoDaysAgo) {
            // Update statuses to 'canceled' for reservations that are 'en cours' and past due
            $reservationsToCancel = Reservation::where('statut', 'en cours')
                                                ->where('date_reservation', '<=', $twoDaysAgo)
                                                ->get();

            foreach ($reservationsToCancel as $reservation) {
                $reservation->statut = 'canceled';
                $reservation->save();
            }

            // Update statuses to 'done' for reservations that are 'accepted' and have reached the end date
            $reservationsToComplete = Reservation::with('service')  // Eager load service
                                                 ->where('statut', 'accepted')
                                                 ->where('date_fin', '<=', $today)
                                                 ->get();

            foreach ($reservationsToComplete as $reservation) {
                // Set the reservation status to 'done' and update the service status to 1 if it exists
                if ($reservation) {
                    $reservation->statut = 'done';
                if ($reservation->service) {
                    $reservation->service->statut = 1;  // Set the service status to 1
                    $reservation->service->save();  // Save the updated service status
                }
                $reservation->save();
            }}
        });

        // Accéder aux variables de session
        $user_cl = Session::get('user_cl');
        $id_cl = Session::get('id_cl');
        $nom_cl = Session::get('nom_cl');
        $prenom_cl = Session::get('prenom_cl');
        $photo_cl = Session::get('photo_cl');
        $password_cl = Session::get('password_cl');
        $adresse_cl = Session::get('adresse_cl');
        $adresse_cl = Session::get('ville');
        $email_cl = Session::get('email_cl');
        $telephone_cl = Session::get('telephone_cl');




        // Récupérer le nombre total de réservations faites par le client
        $totalReservations = Reservation::where('id_client', $id_cl)->count();

        // Récupérer le nombre de réservations traitées (statut = 'traitee')
        $treatedReservations = Reservation::where('id_client', $id_cl)
                                          ->where('statut', 'done')
                                          ->count();

        // Récupérer le nombre total de commentaires faits par le client
        $totalComments = CommentaireClient::count();

        // Récupérer le nombre total de partenaires dans la base de données
        $totalPartenaires = Partenaire::count();


        //comments

        $today = Carbon::today();
        $sevenDaysAfter = $today->copy()->addDays(7);

        $reservations = Reservation::with(['client', 'service'])
            ->where('date_fin', '<=', $today->format('Y-m-d')) // La date de fin doit être aujourd'hui ou dans le passé
            ->where('date_fin', '>=', $today->copy()->subDays(7)->format('Y-m-d'))
            ->where('statut', 'done') // La date de fin ne doit pas être plus vieille que 7 jours
            ->whereDoesntHave('commentaireClient') // Vérifie que la réservation n'a pas déjà un commentaire
            ->where('id_client', $id_cl)
            ->get();


        return view('client.dash', compact('totalReservations', 'treatedReservations', 'totalComments', 'totalPartenaires','today','reservations'));


    }

    public function view_dashClient(){
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
    // Vue du profil
    public function ProfileForm()
    {
        $client = auth()->user(); // Récupérer le client connecté
        $clientId = Session::get('id');

        return view('client.profile', compact('client'));
    }

    public function activate($id)
{
    $client = Client::findOrFail($id);
    $client->is_active = true;
    $client->save();
    return redirect()->back()->with('success', 'Client activated successfully.');
}

public function deactivate($id)
{
    $client = Client::findOrFail($id);
    $client->is_active = false;
    $client->save();
    return redirect()->back()->with('success', 'Client deactivated successfully.');
}


    // Modifier le profil
    public function editProfile()
    {
        return view('client.edit_profile');
    }

    public function updateProfile(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'nom_cl' => 'required|string|max:255',
            'prenom_cl' => 'required|string|max:255',
            'email_cl' => 'required|string|max:255',
            'adresse_cl' => 'required|string|max:255',
            'telephone_cl' => 'required|string|max:10',
            'photo_cl' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'current_password' => 'required_with:password', // Required if password is changed
            'password' => 'nullable|confirmed', // Ensure the password is confirmed
        ]);
        $clientId = Session::get('id_cl');
        $client = Client::find($clientId);
            // Check if the old password is correct
     // Check if the old password is correct
     if ($request->filled('current_password') && !Hash::check($request->current_password, $client->password)) {
        return back()->with('error', 'Your current password does not match our records.');
    }

    // Manual check for password confirmation
    if ($request->filled('password')) {
        if ($request->password !== $request->password_confirmation) {
            return back()->with('error', 'New password and confirmation password do not match.');
        }
    }

        $updateData = [
            'nom_cl' => $request->nom_cl,
            'prenom_cl' => $request->prenom_cl,
            'email' => $request->email_cl,
            'adresse' => $request->adresse_cl,
            'telephone' => $request->telephone_cl
        ];

        if ($request->hasFile('photo_cl')) {
            $file = $request->file('photo_cl');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/client'), $filename);
            $updateData['photo_cl'] = $filename;
        }

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $affectedRows = Client::where('id', $clientId)->update($updateData);

        if ($affectedRows > 0) {
            // Mettre à jour toutes les informations du profil dans la session
            Session::put('nom_cl', $updateData['nom_cl']);
            Session::put('prenom_cl', $updateData['prenom_cl']);
            Session::put('email_cl', $updateData['email']);
            Session::put('adresse_cl', $updateData['adresse']);
            Session::put('telephone_cl', $updateData['telephone']);
            if (isset($updateData['photo_cl'])) {
                Session::put('photo_cl', $updateData['photo_cl']);
            }

            return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès !');
        } else {
            return redirect()->route('profile')->with('error', 'La mise à jour du profil a échoué.');
        }
    }



    public function part_search()
    {
        $partenaire = Partenaire::orderBy('created_at', 'desc');

        if (request()->has('search')) {
            $search = request()->get('search');
            $partenaire = $partenaire->where(function ($query) use ($search) {
                $query->where('nbr_experience', 'like', '%' . $search . '%')
                      ->orWhere('ville', 'like', '%' . $search . '%');

            });
        }

        return view('client.partenaire', ['partenaire' => $partenaire->paginate(5)]);
    }


    public function demande_search()
    {
        $query = Reservation::orderBy('reservations.created_at', 'desc')
                            ->join('services', 'reservations.id_service', '=', 'services.id')
                            ->join('partenaire', 'services.id_expert', '=', 'partenaire.id');

        // Recherche par 'heure'
        if (request()->has('search')) {
            $search = request()->get('search');
            $query->where(function ($q) use ($search) {
                $q->orWhere('reservations.date_reservation', 'like', '%' . $search . '%')
                  ->orWhere('reservations.statut', 'like', '%' . $search . '%')
                  ->orWhere('services.nom_service', 'like', '%' . $search . '%')
                  ->orWhere('partenaire.nom_par', 'like', '%' . $search . '%'); // Searching for partners' names
            });
        }

        // Ajouter plus de paramètres si nécessaire
        // Par exemple, recherche spécifique pour 'statut'
        if (request()->has('statut')) {
            $statut = request()->get('statut');
            $query->where('reservations.statut', $statut);
        }

        // Recherche spécifique pour 'date_reservation'
        if (request()->has('date')) {
            $date = request()->get('date');
            $query->whereDate('reservations.date_reservation', '=', $date);
        }

        // Recherche spécifique pour 'service'
        if (request()->has('service')) {
            $service = request()->get('service');
            $query->where('services.id', '=', $service);
        }

        // Recherche spécifique pour 'partenaire' (expert)
        if (request()->has('partenaire')) {
            $partenaire = request()->get('partenaire');
            $query->where('partenaires.id', '=', $partenaire);
        }

        // Continuer à ajouter plus de conditions selon les besoins

        $demandes = $query->paginate(5);
        return view('client.demandes', compact('demandes'));
    }

//partenaireProfile
public function partenaire_info($id)
{
    // Fetch the partner data from the database including average rating
    $partenaire = Partenaire::findOrFail($id);

    // Fetch services with statut = 1 (active services)
    $services = Service::where('id_expert', $id)
                       ->where('statut', 1)
                       ->get();

    // Calculate the average rating using the method defined in the Partenaire model
    $averageRating = $partenaire->averageRating();

    // Pass partner data, services, and average rating to the view
    return view('client.partenaire_info', compact('partenaire', 'services', 'averageRating'));
}

//-------------Reservation----
public function showReservationForm($id_expert)
{
    // Retrieve only active services for the specific expert
    $services = Service::where('id_expert', $id_expert)
                       ->where('statut', 1)
                       ->get();

    return view('client.make_reservation', compact('services'));
}



public function makeReservation(Request $request)
{
    // Validation
    $request->validate([
        'service' => 'required|exists:services,id',
        'duree' => 'required',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after:date_debut',
    ]);

    // Process reservation data
    $serviceId = $request->input('service');

    // Retrieve the authenticated client's ID
    $clientId = Session::get('id_cl');

    // Retrieve service details
    $service = Service::findOrFail($serviceId);
    $prix = $service->prix;

    // Calculate total price
    $duree = $request->input('duree');
    $prixTotal = $prix * $duree;

    // Create a new reservation record
    $reservation = new Reservation();
    $reservation->id_client = $clientId;
    $reservation->id_service = $serviceId;
    $reservation->duree = $duree;
    $reservation->date_debut = $request->input('date_debut');
    $reservation->date_fin = $request->input('date_fin');
    $reservation->date_reservation = now(); // Current date
    $reservation->prix_totale = $prixTotal;
    $reservation->statut = 'en cours'; // Set the default status to 'en cours'

    // Save the reservation
    $reservation->save();


    return redirect()->back()->with('success', 'Reservation made successfully!');
}


}




