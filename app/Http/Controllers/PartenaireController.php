<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partenaire;
use Illuminate\Support\Facades\Session;
use App\Models\Service;
use App\Models\Reservation;
use App\Http\Controllers\get;


class PartenaireController extends Controller
{
    public function complete_profile(){
        return view('partenaire.complete_profile');
    }
    public function editProfilePartenaire()
    {
        $partenaireId = Session::get('id_par');
        $partenaire = Partenaire::find($partenaireId);
        $services = Service::where('id_expert', $partenaireId)->get();
    
        // Define $servicesOptions here
        $servicesOptions = [
            'bricolage' => [
                "Appliance installation",
                "Home security system installation",
                "Heating and air conditioning (HVAC) installation",
                "Curtain and blinds installation",
                "Plumbing repair",
                "Handle installation"
            ],
            'jardinage' => [
                "Landscape design",
                "Garden lighting",
                "Garden cleaning",
                "Lawn treatment",
                "Deck and patio construction",
                "Hedge maintenance",
                "Seasonal maintenance services"
            ]
        ];
    
        // Pass $servicesOptions to the view
        return view('partenaire.edit_profile_par', compact('partenaire', 'services', 'servicesOptions'));
    }

    public function ProfileForm()
{
    $partenaire = auth()->user(); // Récupérer le partenaire connecté
    $partenaireId = Session::get('id_par');
    $services = Service::where('id_expert', $partenaireId)->get(); // Retrieve services associated with the partenaire

    return view('partenaire.profile', compact('partenaire', 'services'));
}

//delete service
public function destroy($id)
{
    $service = Service::findOrFail($id);
    $service->delete();

    return redirect()->back()->with('success', 'Service deleted successfully.');
}
    public function activate($id)
{
    $partenaire = Partenaire::findOrFail($id);
    $partenaire->is_active = 1;
    $partenaire->save();
    return redirect()->back()->with('success', 'Partenaire activated successfully.');
}

public function deactivate($id)
{
    $partenaire = Partenaire::findOrFail($id);
    $partenaire->is_active = 0;
    $partenaire->save();
    return redirect()->back()->with('success', 'Partenaire deactivated successfully.');
}

public function showDemandes()
{
    $partenaireId = Session::get('id_par');
    $Reservations = Reservation::whereHas('service', function ($query) use ($partenaireId) {
        $query->where('id_expert', $partenaireId);
    })->where('statut', 'en cours')
      ->with(['service', 'client'])
      ->get();  // This should be recognized properly

    return view('partenaire.demandes', compact('Reservations'));
}


}
