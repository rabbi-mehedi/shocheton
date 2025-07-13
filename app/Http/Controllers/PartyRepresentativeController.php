<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\PartyRepresentative;
use App\Models\PoliticalParty;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\ReportFlag;

class PartyRepresentativeController extends Controller
{
    public function flagReport(Request $request, Report $report)
    {
        $request->validate([
            'flag_type' => 'required|in:False Information,Insufficient Evidence',
            'comment' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();

        // Prevent duplicate flags
        $existingFlag = ReportFlag::where('user_id', $user->id)
            ->where('report_id', $report->id)
            ->first();

        if ($existingFlag) {
            return back()->with('error', 'You have already flagged this report.');
        }

        ReportFlag::create([
            'user_id' => $user->id,
            'report_id' => $report->id,
            'flag_type' => $request->flag_type,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Report flagged successfully.');
    }

    public function showReport(Report $extortionReport)
    {
        $user = Auth::user();
        $representative = $user->partyRepresentative;

        if (!$representative) {
            abort(403, 'Unauthorized action.');
        }

        $partyName = $representative->party->name;
        
        // Ensure the report is an extortion report and belongs to the representative's party
        if ($extortionReport->report_type !== 'extortionist' || 
            $extortionReport->extortionist->political_affiliation !== $partyName) {
            abort(403, 'You are not authorized to view this report.');
        }

        // Check category-based access
        $categories = $representative->categories;
        $hasAccess = $categories->contains('name', 'All Divisions') || 
                     $categories->contains('district', $extortionReport->extortionist->business_address_district);

        if (!$hasAccess) {
            abort(403, 'You are not authorized to view reports from this district.');
        }

        // Reuse the admin view for showing the report
        return view('admin.extortion.view', ['report' => $extortionReport]);
    }

    public function dashboard()
    {
        $user = Auth::user();
        $representative = $user->partyRepresentative;

        if (!$representative) {
            // This should not happen if middleware is set up correctly
            abort(403, 'You are not a party representative.');
        }

        $partyName = $representative->party->name;

        $reports = \App\Models\Extortionist::where('political_affiliation', $partyName)
            ->with('report') // Eager load the main report details
            ->latest()
            ->get();

        return view('representative.dashboard', compact('reports', 'partyName'));
    }

    public function create()
    {
        $parties = PoliticalParty::all();
        return view('representative.register', compact('parties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'party_id' => 'required|exists:political_parties,id',
            'designation' => 'nullable|string|max:255',
            'g-recaptcha-response' => 'required',
        ]);

        try {
            // Create or find user
            $password = 'changeme123';
            $user = User::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                    'role' => 'representative-pending',
                    'password' => Hash::make($password),
                ]
            );

            // Update user phone and name
            $user->update([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'role' => 'representative-pending',
            ]);

            // Create representative application
            PartyRepresentative::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'party_id' => $validated['party_id'],
                    'designation' => $validated['designation'],
                    'status' => 'pending',
                ]
            );

            return redirect()->route('representative.register')
                ->with('success', 'Your application has been submitted and is pending approval.');
        } catch (\Exception $e) {
            Log::error('Error submitting party representative registration', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'An error occurred. Please try again later.'])->withInput();
        }
    }
} 