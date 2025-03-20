<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyContact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EmergencyContactController extends Controller
{
    public function __invoke()
    {
        $emergencyContacts = EmergencyContact::all();
        return view('emergency.contacts.index',compact('emergencyContacts'));
    }

    public function create()
    {
        return view('emergency.contacts.create');
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'name'     => 'required|string|max:255',
            'relation' => 'required|string|max:50',
            'phone'    => [
                'required',
                'string',
                'max:20',
                Rule::unique('emergency_contacts')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
            'email'    => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('emergency_contacts')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
        ]);
        
        // Create the emergency contact associated with the authenticated user
        Auth::user()->emergencyContacts()->create([
            'name'     => $request->name,
            'relation' => $request->relation,
            'phone'    => $request->phone,
            'email'    => $request->email,
        ]);
        
        // Redirect back to the index (or wherever you wish) with a success message
        return redirect()->route('emergency.contacts')
                         ->with('success', 'Emergency contact added successfully.');
    }

    public function edit(EmergencyContact $emergencyContact)
    {
        return view('emergency.contacts.edit', compact('emergencyContact'));
    }

    public function update(Request $request, EmergencyContact $emergencyContact)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'relation' => 'required|string|max:50',
            'phone'    => 'required|string|max:20',
            'email'    => 'nullable|email|max:255'
        ]);

        $emergencyContact->update($request->only(['name','relation','phone','email']));

        return redirect()->route('emergency.contacts')
                        ->with('success', 'Emergency contact updated successfully.');
    }

    public function destroy(EmergencyContact $emergencyContact)
    {
        // Optional: Ensure the contact belongs to the current user.
        // If you have a policy, you could use `authorize('delete', $emergencyContact)` instead.
        if ($emergencyContact->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $emergencyContact->delete();

        return redirect()
            ->route('emergency.contacts')
            ->with('success', 'Emergency contact deleted successfully.');
    }

}
