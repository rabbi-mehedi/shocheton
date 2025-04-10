<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Offender;

class HeatmapController extends Controller
{
    public function index(Offender $offender)
    { 

        // Group by location and count how many times each appeared
        $locations = $offender
            ->select('location', DB::raw('COUNT(*) as count'))
            ->whereNotNull('location')
            ->groupBy('location')
            ->get();

        // dd($locations);

        $geocodedData = [];

        foreach ($locations as $loc) {
            $coords = $this->geocodeLocation($loc->location);
            if ($coords) {
                $geocodedData[] = [
                    'latitude' => $coords['lat'],
                    'longitude' => $coords['lng'],
                    'count' => $loc->count,
                    'radius' => 1000
                ];
            }
        }

        // $geocodedData = 'true';

        // return response()->json($geocodedData);
        return view('heatmap.index',compact('geocodedData')); // No location input needed
    }

    private function geocodeLocation($location)
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $encodedLocation = urlencode($location);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$encodedLocation}&key={$apiKey}";

        $response = @file_get_contents($url);
        if ($response === FALSE) return null;

        $data = json_decode($response, true);
        if ($data['status'] === 'OK') {
            return $data['results'][0]['geometry']['location'];
        }

        return null;
    }
}
