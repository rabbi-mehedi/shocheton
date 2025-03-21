<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offender;
use App\Models\Report;

class SearchController extends Controller
{
    public function results(Request $request)
    {
        $q = $request->query('query'); // or $request->get('query')

        // Example search logic across Offenders & Reports:
        // Adjust fields as needed
        // 1. Offenders: only those with an associated Report that has 'verified' = true
        $offenders = Offender::with('report')
        ->whereHas('report', function ($query) {
            $query->where('verified', true);
        })
        ->where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%")
                ->orWhere('location', 'like', "%$q%")
                ->orWhere('crime_description', 'like', "%$q%")
                ->orWhere('offense_type', 'like', "%$q%");
        })
        ->get();

        // 2. Reports: only the reports that are verified = true
        $reports = Report::with('offender')
        ->where('verified', true)
        ->where(function ($query) use ($q) {
            $query->where('police_station', 'like', "%$q%")
                ->orWhere('additional_details', 'like', "%$q%");
        })
        ->get();

        // Return a view, passing the results + the original query
        return view('search.results', [
            'offenders' => $offenders,
            'reports' => $reports,
            'query' => $q,
        ]);
    }
    
}
