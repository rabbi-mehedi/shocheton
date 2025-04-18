<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\Offender;

class HeatmapController extends Controller
{
    /**
     * Display the heatmap of offender locations
     *
     * @param Offender $offender
     * @return \Illuminate\View\View
     */
    public function index(Offender $offender)
    { 
        // Cache key for geocoded data
        $cacheKey = 'heatmap_geocoded_data';
        $cacheDuration = 60 * 24; // 24 hours in minutes

        // Try to get data from cache first
        $geocodedData = Cache::remember($cacheKey, $cacheDuration, function () use ($offender) {
            // Group by location and count how many times each appeared
            $locations = $offender
                ->select('location', DB::raw('COUNT(*) as count'))
                ->whereNotNull('location')
                ->where('location', '!=', '') // Exclude empty strings
                ->groupBy('location')
                ->get();
            
            $geocodedData = [];
            $failedLocations = 0;
            
            // Batch processing with rate limiting for Google API
            foreach ($locations as $index => $loc) {
                // Add small delay every 5 requests to avoid hitting API limits
                if ($index > 0 && $index % 5 === 0) {
                    usleep(200000); // 200ms sleep
                }
                
                try {
                    $coords = $this->geocodeLocation($loc->location);
                    if ($coords) {
                        // Calculate radius based on count (min 300, max based on count)
                        $radius = min(300 + ($loc->count * 50), 2000);
                        
                        $geocodedData[] = [
                            'latitude' => $coords['lat'],
                            'longitude' => $coords['lng'],
                            'count' => $loc->count,
                            'radius' => $radius
                        ];
                    } else {
                        $failedLocations++;
                    }
                } catch (\Exception $e) {
                    Log::warning("Error geocoding location: {$loc->location}", [
                        'error' => $e->getMessage()
                    ]);
                    $failedLocations++;
                }
            }
            
            // Log summary of geocoding process
            if ($failedLocations > 0) {
                Log::info("Heatmap geocoding completed with {$failedLocations} failed locations out of " . count($locations));
            }
            
            return $geocodedData;
        });

        return view('heatmap.index', compact('geocodedData'));
    }

    /**
     * Geocode a location string to latitude/longitude coordinates
     *
     * @param string $location
     * @return array|null
     */
    private function geocodeLocation($location)
    {
        // Check if we've already geocoded this location recently (30 days cache)
        $cacheKey = 'geocode_' . md5($location);
        
        return Cache::remember($cacheKey, 60 * 24 * 30, function () use ($location) {
            $apiKey = env('GOOGLE_MAPS_API_KEY');
            
            if (empty($apiKey)) {
                Log::error('Google Maps API key is not configured');
                return null;
            }
            
            $encodedLocation = urlencode($location);
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$encodedLocation}&key={$apiKey}";
            
            try {
                // Use cURL instead of file_get_contents for better error handling
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $error = curl_error($ch);
                curl_close($ch);
                
                if ($response === FALSE || $httpCode !== 200) {
                    Log::error("Geocoding request failed: HTTP $httpCode, Error: $error", [
                        'location' => $location
                    ]);
                    return null;
                }
                
                $data = json_decode($response, true);
                
                if ($data['status'] === 'OK') {
                    return $data['results'][0]['geometry']['location'];
                } else {
                    Log::warning("Geocoding failed with status: {$data['status']}", [
                        'location' => $location,
                        'error_message' => $data['error_message'] ?? 'No error message'
                    ]);
                }
            } catch (\Exception $e) {
                Log::error("Exception during geocoding: " . $e->getMessage(), [
                    'location' => $location
                ]);
            }
            
            return null;
        });
    }
}
