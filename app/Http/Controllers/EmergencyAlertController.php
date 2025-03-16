<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmergencyAlert;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EmergencyAlertController extends Controller
{
    public function __invoke()
    {
        // Fetch alerts from the last hour
        $alerts = EmergencyAlert::where('created_at', '>=', Carbon::now()->subHour())->get();
        
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
        $data['user_id'] = auth()->user()->id; // or set null if user not logged in

        // Create new record
        $alert = EmergencyAlert::create($data);

        return response()->json([
            'success' => true,
            'alert'   => $alert,
        ]);
    }

    public function destroy($id)
    {
        // Optionally check if (Auth::user()->isAdmin()) to ensure only admins can do this
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $alert = EmergencyAlert::findOrFail($id);
        $alert->delete();

        return redirect()
            ->route('emergency.index')
            ->with('status', 'Alert deleted successfully!');
    }

    public function locate(Request $request)
    {
        // You can do any extra checks or pass data if needed
        // For now, we just return the blade
        return view('emergency.locate');
    }

}
