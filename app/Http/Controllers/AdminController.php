<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offender;
use App\Models\Report;


class AdminController extends Controller
{
    public function __invoke(User $user, Offender $offender, Report $report)
    {
        $allUsers = $user::latest()->get();
        $allOffenders = $offender::latest()->get();
        $allReports = $report::latest()->get();

        return view('admin.dashboard',compact('allUsers','allOffenders','allReports'));
    }

    public function users(User $user)
    {
        $allUsers = $user::latest()->get();
        return view('admin.users.index', compact('allUsers'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'role' => 'required|in:user,admin',
        ]);
    
        $user->update($validated);
    
        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully.');
    }

    public function offenders(Offender $offender)
    {
        $allOffenders = $offender::latest()->get();
        return view('admin.offenders.index',compact('allOffenders'));
    }

    public function offenderEdit(Offender $offender)
    {
        return view('admin.offenders.edit',[
            'offender' => $offender
        ]);
    }

    public function offenderUpdate(Request $request, Offender $offender)
    {

    }

    public function reports(Report $report)
    {
        $allReports = $report::latest()->get();
        return view('admin.reports.index',compact('allReports'));
    }

    public function reportEdit(Report $report)
    {
        return view('admin.reports.edit', [
            'report' => $report
        ]);
        
    }

    public function reportUpdate(Request $request, Report $report)
    {
        $validated = $request->validate([
            'offender_relation_to_victim' => 'nullable|string',
            'police_status' => 'nullable|in:unreported,in-progress,reported',
            'police_station' => 'nullable|string|max:255',
            'needs_legal_support' => 'nullable|boolean',
            'needs_ngo_support' => 'nullable|boolean',
            'privacy_level' => 'required|in:public,private',
            'contact_permission' => 'nullable|boolean',
            'additional_details' => 'nullable|string',
            'verified' => 'nullable|boolean',
        ]);
    
        // Convert checkboxes (which return "1" or null) to booleans
        $validated['needs_legal_support'] = $request->has('needs_legal_support');
        $validated['needs_ngo_support'] = $request->has('needs_ngo_support');
        $validated['contact_permission'] = $request->has('contact_permission');
        $validated['verified'] = $request->has('verified');
    
        $report->update($validated);
    
        return redirect()->route('admin.reports')
            ->with('success', 'Report updated successfully.');
    }
}
