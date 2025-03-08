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
        $offenders = Offender::with('report')
            ->where('name', 'like', "%$q%")
            ->orWhere('location', 'like', "%$q%")
            ->orWhere('crime_description', 'like', "%$q%")
            ->orWhere('offense_type', 'like', "%$q%")
            ->get();

        $reports = Report::with('offender')
            ->orWhere('police_station', 'like', "%$q%")
            ->orWhere('additional_details', 'like', "%$q%")
            ->get();

        // Return a view, passing the results + the original query
        return view('search.results', [
            'offenders' => $offenders,
            'reports' => $reports,
            'query' => $q,
        ]);
    }
    
}
