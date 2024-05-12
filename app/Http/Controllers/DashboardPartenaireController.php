<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Partenaire;
use App\Models\Reservation;
use App\Models\CommentaireExpert;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardPartenaireController extends Controller
{
    // Afficher le tableau de bord partenaire
    public function dashboardpartenaire(){
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
                $reservation->statut = 'done';
                if ($reservation->service) {
                    $reservation->service->statut = 1;  // Set the service status to 1
                    $reservation->service->save();  // Save the updated service status
                }
                $reservation->save();
            }
        });
        //Accéder aux variables de session
        $user_par = Session::get('user_par');
        $id_par = Session::get('id_par');
        $nom_par = Session::get('nom_par');
        $prenom_par = Session::get('prenom_par');
        $password_par = Session::get('password_par');
        $ville_par = Session::get('ville_par');
        $email_par = Session::get('email_par');
        $photo_par = Session::get('photo_par');
        $nbr_experience_parr = Session::get('nbr_experience_par');
        $domaine_expertise_par = Session::get('domaine_expertise_par');
    // Récupérer les services offerts par ce partenaire
    $servicesIds = Service::where('id_expert', $id_par)->pluck('id');


        // Récupérer le nombre total de réservations faites par le client
         // Compter les réservations totales et les réservations traitées pour les services du partenaire
    $totalReservations = Reservation::whereIn('id_service', $servicesIds)->count();
    $treatedReservations = Reservation::whereIn('id_service', $servicesIds)
                                      ->where('statut', 'done')
                                      ->count();
        // Récupérer le nombre total de commentaires faits par le client
        $totalComments = CommentaireExpert::count();

        // Récupérer le nombre total de partenaires dans la base de données
        $totalClients = Client::count();


        //comments

        $today = Carbon::today();
        $sevenDaysAfter = $today->copy()->addDays(7);

        $reservations = Reservation::with(['client', 'service'])
            ->where('date_fin', '<=', $today->format('Y-m-d')) // La date de fin doit être aujourd'hui ou dans le passé
            ->where('date_fin', '>=', $today->copy()->subDays(7)->format('Y-m-d'))
            ->where('statut', 'done') // La date de fin ne doit pas être plus vieille que 7 jours
            // La date de fin ne doit pas être plus vieille que 7 jours
            ->whereDoesntHave('commentaireExpert') // Vérifie que la réservation n'a pas déjà un commentaire
            ->whereHas('service', function ($query) use ($id_par) {
                $query->where('id_expert', $id_par);
            })
            ->get();



        return view('partenaire.dash_partenaire',compact('reservations','totalClients', 'totalComments','totalReservations', 'treatedReservations'));
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
        Session::forget('nbr_experience_par');
        Session::forget('domaine_expertise_par');


        return redirect()->route('login');
    }
       ///----------------------------------------------------------------
       public function complete_profile_par(Request $request)
       {
           $expertId = Session::get('id_par');
           // Validate the incoming request data
           $validatedData = $request->validate([
               // Define validation rules for each input field
               'services.*.service' => 'required|string',
           'services.*.creneau' => 'required|string',
           'services.*.prix' => 'required|numeric',

           ]);
           foreach ($request->services as $serviceData) {
               $service = new Service();
               $service->id_expert = $expertId;
               $service->nom_service = $serviceData['service'];
               $service->crenau_dispo = $serviceData['creneau'];
               $service->prix = $serviceData['prix'];
               $service->statut = 1;
               $service->save();
           }
               // Update the 'connexion' field in the 'partenaire' table
               Partenaire::where('id', $expertId)->update(['connexion' => 1]);

           // Optionally, you can redirect the user after saving the data
           return redirect()->route('dashboard_partenaire')->with('success', 'Services saved successfully.');
       }



    public function updateProfilePartenaire(Request $request)
    {
        $request->validate([
            // Validation rules for partenaire information
            'nom_par' => 'required',
            'prenom_par' => 'required',
            'email_par' => 'required|email',
            'ville_par' => 'required',
            'nbr_experience' => 'required|integer',
            'domaine_expertise' => 'required',
            // Validation rules for services
            'services.*.service' => 'required|string',
            'services.*.creneau' => 'required|string',
            'services.*.prix' => 'required|numeric',
        ]);

        // Retrieve the connected partenaire's ID from the session
        $partenaireId = Session::get('id_par');

        // Update partenaire information
        $partenaire = Partenaire::find($partenaireId);
        $partenaire->nom_par = $request->input('nom_par');
        $partenaire->prenom_par = $request->input('prenom_par');
        $partenaire->email = $request->input('email_par');
        $partenaire->ville = $request->input('ville_par');
        $partenaire->nbr_experience = $request->input('nbr_experience');
        $partenaire->domaine_expertise = $request->input('domaine_expertise');

        // Update partenaire photo if provided
        if ($request->hasFile('photo_par')) {
            $photo_par = $request->file('photo_par');
            $fileName = time() . '_' . $photo_par->getClientOriginalName();
            $photo_par->move(public_path('uploads/partenaire'), $fileName);
            $partenaire->photo_par = $fileName;
        }

        // Save the updated partenaire information
        $partenaire->save();

           // Update session data
    Session::put('nom_par', $partenaire->nom_par);
    Session::put('prenom_par', $partenaire->prenom_par);
    Session::put('email_par', $partenaire->email);
    Session::put('ville_par', $partenaire->ville);
    Session::put('nbr_experience', $partenaire->nbr_experience);
    Session::put('domaine_expertise', $partenaire->domaine_expertise);
    if ($request->hasFile('photo_par')) {
        Session::put('photo_par', $fileName); // Update session with the new file name
    }
        // Update service information if provided
        if ($request->has('services') && is_array($request->services)) {
            foreach ($request->services as $serviceData) {
                Service::updateOrCreate(
                    [
                        'id_expert' => $partenaireId,
                        'nom_service' => $serviceData['service'],
                        'crenau_dispo' => $serviceData['creneau'],
                        'prix' => $serviceData['prix'],
                        'statut'=>1,
                    ]
                );
            }
        }

        // Redirect back with success message
        return redirect()->route('partenaire_profile')->with('success', 'Profile updated successfully');
    }

//delete
public function destroy($id)
{
    $service = Service::find($id);
    if ($service) {
        $service->delete();
        return redirect()->route('dashboard_partenaire')->with('success', 'Service supprimé avec succès');
    } else {
        return redirect()->route('dashboard_partenaire')->with('error', 'Service introuvable');
    }
}


}
