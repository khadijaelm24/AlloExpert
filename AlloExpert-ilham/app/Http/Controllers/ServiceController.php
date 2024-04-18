<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation; // Add this line to import the Reservation model
use App\Models\Partenaire; // Add this line to import the Partenaire model
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function create()
    {
        // Retrieve the list of partners to populate the dropdown
        $partenaires = Partenaire::all();
        return view('client.add-service', compact('partenaires'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'service' => 'required|string',
            'date_reservation' => 'required|date',
            'heure' => 'required|date_format:H:i',
            'partenaire' => 'required|exists:partenaire,id', // Assuming you name your select input 'partenaire'
        ]);
    
        // Retrieve the client ID from the session
        $id_cl = Session::get('id_cl');
    
        // Retrieve the partner information
        $partenaire = Partenaire::findOrFail($validatedData['partenaire']);
    
        // Create new reservation
        $reservation = new Reservation();
        $reservation->status = 'in progress';
        $reservation->service = $validatedData['service'];
        $reservation->date_reservation = $validatedData['date_reservation'];
        $reservation->heure = $validatedData['heure'];
        $reservation->partenaire_nom = $partenaire->nom_par; // Assuming your Reservation model has a 'partenaire_nom' field
        $reservation->partenaire_prenom = $partenaire->prenom_par; // Assuming your Reservation model has a 'partenaire_prenom' field
        $reservation->id_clt = $id_cl;
        $reservation->save();
    
        // Redirect to a success page or anywhere you want
        return redirect()->route('services.create')->with('success', 'Service added successfully.');
    }
}
