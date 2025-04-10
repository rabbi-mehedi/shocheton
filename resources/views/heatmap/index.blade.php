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

    <!-- Map Container -->
    <div id="map" style="height: 900px; width: 1100px;"></div>
</div>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>

<script>
// Initialize the map
let map;
function initMap() {
    const defaultCenter = { lat: 23.8103, lng: 90.4125 }; // Center on Dhaka

    // Initialize the map
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: defaultCenter,
    });

    // Geocoded data passed from the controller
    const geocodedData = @json($geocodedData);

    // Create circles based on geocoded data
    geocodedData.forEach((loc) => {
        const circle = new google.maps.Circle({
            strokeColor: '#FF0000',   // Red border
            strokeOpacity: 0.7,       // Border opacity
            strokeWeight: 1,          // Border thickness
            fillColor: '#FF0000',     // Red fill
            fillOpacity: 0.35,        // Fill opacity
            map: map,
            center: { lat: loc.latitude, lng: loc.longitude },
            radius: 500 + Math.min(loc.count * 100, 1000) // Radius based on offense count
        });

        // Show metadata on hover
        const infowindow = new google.maps.InfoWindow({
            content: `Location: ${loc.latitude}, ${loc.longitude}<br>Offenses: ${loc.count}`
        });

        circle.addListener('mouseover', function() {
            infowindow.setPosition(circle.getCenter());
            infowindow.open(map);
        });
    });
}

// Initialize the map when the page loads
window.onload = initMap;
</script>
@endsection
