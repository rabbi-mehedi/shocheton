@extends('layouts.user') 
@section('page_title', 'Offense Heatmap') 

@section('page_content')
<div class="w-full flex justify-center flex-col items-center">
    <!-- Logo -->
    <a href="{{ route('home') }}">
        <img src="{{ asset('wide_logo.png') }}" alt="shocheton.org" class="my-6 h-[10vh]">
    </a>

    <!-- Header -->
    <header class="bg-red-600 text-white py-4 w-full">
        <div class="container mx-auto px-4 max-w-5xl flex flex-col md:flex-row items-center justify-center">
            <h1 class="text-2xl md:text-3xl font-bold uppercase tracking-wide md:tracking-wider leading-tight text-center md:text-left">
                Offense Heatmap
            </h1>
        </div>
    </header>

    <!-- Map Container with loading indicator -->
    <div class="relative">
        <div id="map-loading" class="absolute inset-0 flex items-center justify-center bg-gray-100 bg-opacity-70 z-10">
            <div class="text-center">
                <div class="spinner-border text-red-600" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="mt-2">Loading map data...</p>
            </div>
        </div>
        <div id="map" style="height: 900px; width: 1100px;"></div>
    </div>
    
    <!-- Map Legend -->
    <div class="bg-white p-4 shadow-md rounded mt-4 w-full max-w-5xl">
        <h3 class="font-bold text-lg mb-2">Map Legend</h3>
        <div class="flex items-center">
            <div class="w-6 h-6 rounded-full bg-red-600 opacity-35 mr-2"></div>
            <span>Offense hotspot (larger circles indicate more incidents)</span>
        </div>
    </div>
</div>

<!-- Google Maps API with callback and error handling -->
<script>
    // Callback function that will be called when the API is loaded
    function initMap() {
        // Hide loading indicator
        document.getElementById('map-loading').style.display = 'none';
        
        const defaultCenter = { lat: 23.8103, lng: 90.4125 }; // Center on Dhaka
        const geocodedData = @json($geocodedData ?? []);

        // Initialize the map with options
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: defaultCenter,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            mapTypeControl: true,
            fullscreenControl: true,
            streetViewControl: true,
            zoomControl: true
        });

        // Handle empty data gracefully
        if (!geocodedData.length) {
            // Create an info window to display message
            const infoWindow = new google.maps.InfoWindow({
                content: '<div class="p-2">No offense data available to display</div>',
                position: defaultCenter
            });
            infoWindow.open(map);
            return;
        }

        // Use heatmap library if available, otherwise fall back to circles
        if (google.maps.visualization && typeof google.maps.visualization.HeatmapLayer === 'function') {
            const heatmapData = geocodedData.map(loc => {
                return {
                    location: new google.maps.LatLng(loc.latitude, loc.longitude),
                    weight: loc.count
                };
            });
            
            const heatmap = new google.maps.visualization.HeatmapLayer({
                data: heatmapData,
                map: map,
                radius: 50,
                gradient: [
                    'rgba(0, 255, 255, 0)',
                    'rgba(0, 255, 255, 1)',
                    'rgba(0, 191, 255, 1)',
                    'rgba(0, 127, 255, 1)',
                    'rgba(0, 63, 255, 1)',
                    'rgba(0, 0, 255, 1)',
                    'rgba(0, 0, 223, 1)',
                    'rgba(0, 0, 191, 1)',
                    'rgba(0, 0, 159, 1)',
                    'rgba(0, 0, 127, 1)',
                    'rgba(63, 0, 91, 1)',
                    'rgba(127, 0, 63, 1)',
                    'rgba(191, 0, 31, 1)',
                    'rgba(255, 0, 0, 1)'
                ]
            });
        } else {
            // Fallback to circle visualization
            geocodedData.forEach((loc) => {
                // Scale radius based on count with min/max limits
                const radius = 300 + Math.min(loc.count * 100, 1500);
                
                const circle = new google.maps.Circle({
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 1,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                    map: map,
                    center: { lat: parseFloat(loc.latitude), lng: parseFloat(loc.longitude) },
                    radius: radius
                });

                // Enhanced info window with more details
                const infowindow = new google.maps.InfoWindow({
                    content: `
                        <div class="p-2">
                            <h4 class="font-bold">Offense Hotspot</h4>
                            <p>Location: ${loc.latitude.toFixed(4)}, ${loc.longitude.toFixed(4)}</p>
                            <p>Total Incidents: <span class="font-bold text-red-600">${loc.count}</span></p>
                        </div>
                    `
                });

                circle.addListener('mouseover', function() {
                    infowindow.setPosition(circle.getCenter());
                    infowindow.open(map);
                });

                circle.addListener('mouseout', function() {
                    infowindow.close();
                });

                circle.addListener('click', function() {
                    map.setZoom(14);
                    map.setCenter(circle.getCenter());
                });
            });
        }

        // Try to center map on data points if available
        if (geocodedData.length > 0) {
            // Find bounds of all points
            const bounds = new google.maps.LatLngBounds();
            geocodedData.forEach(loc => {
                bounds.extend(new google.maps.LatLng(
                    parseFloat(loc.latitude), 
                    parseFloat(loc.longitude)
                ));
            });
            map.fitBounds(bounds);
        }
    }

    // Error handler for the Google Maps API
    function handleMapError() {
        document.getElementById('map').innerHTML = `
            <div class="bg-red-100 p-4 rounded text-red-700">
                <h3 class="font-bold">Map Loading Error</h3>
                <p>There was an error loading the Google Maps API. Please try again later.</p>
            </div>
        `;
        document.getElementById('map-loading').style.display = 'none';
    }
</script>

<!-- Load Google Maps API asynchronously -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=visualization&callback=initMap&v=weekly"
    onerror="handleMapError()">
</script>
@endsection
