<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmergencyAlert;
use Illuminate\Support\Facades\Auth;

class EmergencyAlertController extends Controller
{
    public function __invoke()
    {
        // Get all alerts. In a real scenario, you might only get recent alerts, etc.
        $alerts = EmergencyAlert::all();
        
        // Pass them to the view
        return view('map', compact('alerts'));
        
    }

    public function store(Request $request)
    {
        // Validate incoming lat/lng
        $data = $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        // Optionally link to an authenticated user, if you have Auth in place
        $data['user_id'] = Auth::id(); // or set null if user not logged in

        // Create new record
        $alert = EmergencyAlert::create($data);

        return response()->json([
            'success' => true,
            'alert'   => $alert,
        ]);
    }
}
