<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;

class ReportController extends Controller
{
    public function __invoke(Report $report)
    {
        $allReports = $report::latest()->with('user','offender')->get();
        return view('admin.reports.index',compact('allReports'));
    }

    public function view(Report $report)
    {
        dd($report);
    }

    public function edit(Report $report)
    {
        return view('admin.reports.edit', [
            'report' => $report
        ]);
    }

    public function update(Request $request, Report $report)
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
