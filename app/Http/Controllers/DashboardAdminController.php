<?php

namespace App\Http\Controllers;


use App\Models\Client;
use App\Models\Partenaire;
use App\Models\CommentaireExpert;
use App\Models\CommentaireClient;
use App\Models\Reservation;
use App\Models\Reclamation;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;


class DashboardAdminController extends Controller
{public function dashboardAdmin()
    {
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

        // Retrieve counts from the database
        $partenaireCount = Partenaire::count();
        $clientCount = Client::count();
        $interventionCount = Reservation::where('statut', 'done')->count();
        $commentCount = CommentaireExpert::count(); // Modify this based on your actual comments model
        $demandeCount = Reservation::count(); // Count all entries in the Reservation table
        $expertCommentCount = CommentaireExpert::count(); // Count all entries in the CommentaireExpert table

        // Pass all counts to the view
        return view('admin.dashboard_admin', compact('partenaireCount', 'clientCount', 'interventionCount', 'commentCount', 'demandeCount', 'expertCommentCount'));
    }





    public function showClients()
{
    $clients = Client::all(); // Fetch all clients
    return view('admin.clients', compact('clients'));
}

public function searchClients(Request $request)
{
    // Get the search term from the query string
    $searchTerm = $request->query('search');

    // Query the clients based on the search term across multiple columns
    $clients = Client::query()
        ->where('nom_cl', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('prenom_cl', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('adresse', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('telephone', 'LIKE', '%' . $searchTerm . '%')
        ->get();

    // Return the view with the filtered clients
    return view('admin.clients', compact('clients'));
}



public function showPartenaires()
{
    // Fetch partenaires with pagination
    $partenaires = Partenaire::all();  // Adjust the number as needed for pagination
    return view('admin.partenaires', compact('partenaires'));
}

public function searchPartenaires(Request $request)
{
    $searchTerm = $request->input('search');

    // Query the database using the search term against all relevant columns
    $partenaires = Partenaire::query()
        ->where('nom_par', 'LIKE', "%{$searchTerm}%")
        ->orWhere('prenom_par', 'LIKE', "%{$searchTerm}%")
        ->orWhere('email', 'LIKE', "%{$searchTerm}%")
        ->orWhere('ville', 'LIKE', "%{$searchTerm}%")
        ->orWhere('domaine_expertise', 'LIKE', "%{$searchTerm}%")
        ->get();

    return view('admin.partenaires', compact('partenaires'));
}


public function showInterventions()
{
    $interventions = Reservation::with(['client', 'service'])
                                ->where('statut', 'done')
                                // ->where('date_fin', '<', now()) // You can adjust this filter as needed
                                ->get();

    return view('admin.interventions', compact('interventions'));
}
public function searchInterventions(Request $request)
{
    $query = $request->input('q');
    $interventions = Reservation::with(['client', 'service'])
                                ->where('statut', 'accepted')
                                ->where(function($q) use ($query) {
                                    $q->where('client.name', 'like', '%' . $query . '%') // Assuming 'name' is a field in 'client'
                                      ->orWhere('service.name', 'like', '%' . $query . '%') // Assuming 'name' is a field in 'service'
                                      ->orWhere('id', 'like', '%' . $query . '%')
                                      ->orWhere('duration', 'like', '%' . $query . '%') // Adjust field names based on your actual database columns
                                      ->orWhere('start_date', 'like', '%' . $query . '%')
                                      ->orWhere('end_date', 'like', '%' . $query . '%');
                                })
                                ->get();

    return response()->json($interventions);
}



public function showReclamations()
{
    // Fetch all reclamations with related client and expert details
    $reclamations = Reclamation::with(['client', 'expert'])->get();

    return view('admin.reclamations', compact('reclamations'));
}

public function search(Request $request)
{
    $searchTerm = $request->input('search');
    $reclamations = Reclamation::query()
        ->whereHas('client', function($query) use ($searchTerm) {
            $query->where('nom_cl', 'like', '%' . $searchTerm . '%')
                  ->orWhere('prenom_cl', 'like', '%' . $searchTerm . '%');
        })
        ->orWhereHas('expert', function($query) use ($searchTerm) {
            $query->where('nom_par', 'like', '%' . $searchTerm . '%')
                  ->orWhere('prenom_par', 'like', '%' . $searchTerm . '%');
        })
        ->orWhere('description', 'like', '%' . $searchTerm . '%')
        ->get();

    return view('admin.reclamations', compact('reclamations'));
}
}
