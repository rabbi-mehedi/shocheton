{{-- resources/views/emergency/locate.blade.php --}}
@extends('layouts.user')

@section('page_title', 'Locate Nearby Services')

@section('page_content')
<div class="container mx-auto mt-6 px-4">

    @php
        // We assume you pass ?type=police or ?type=hospital in the query string
        $serviceType = request('type') ?? 'police';
        // For display
        $serviceLabel = ucfirst($serviceType);
    @endphp

    <h1 class="text-2xl font-bold text-gray-900 mb-4">
        Nearby {{ $serviceLabel }} Stations
    </h1>

    <p class="text-gray-600 text-sm mb-4">
        Showing the nearest {{ $serviceType }} facilities based on your current location.
    </p>

    <!-- The map container -->
    <div id="map" class="w-full h-64 sm:h-96 border border-gray-300 rounded mb-4"></div>

    <!-- Results list -->
    <div id="results" class="space-y-3">
        <p class="text-sm text-gray-500">Searching for nearby {{ $serviceLabel }} ...</p>
    </div>

</div>

<!-- Load Google Maps + Places library, but no callback param. -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdSsNxBZzj0YHjJlulOmiKqF1VsA0HZFs&libraries=places"
    async
    defer
></script>

<script>
    let map;
    let service;
    let infowindow;
    let markers = [];

    // The placeType is either 'police' or 'hospital' from query string
    const placeType = "{{ $serviceType }}"; 

    // 1) We'll wait for the window to load before calling initMap
    window.addEventListener('load', () => {
        initMap();
    });

    function initMap() {
        // A fallback center (Bangladesh) if geolocation fails
        const fallbackCenter = { lat: 23.6850, lng: 90.3563 };

        // Try to get the user's location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                position => {
                    const userPos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    setupMap(userPos);
                },
                error => {
                    console.warn('Geolocation error:', error);
                    setupMap(fallbackCenter); // fallback
                },
                { enableHighAccuracy: true, timeout: 15000 }
            );
        } else {
            // If no geolocation support, use fallback
            setupMap(fallbackCenter);
        }
    }

    function setupMap(centerPos) {
        // Initialize the map
        map = new google.maps.Map(document.getElementById('map'), {
            center: centerPos,
            zoom: 14,
            // Example: If you want to apply your custom style:
            // styles: [ /* your custom style JSON here */ ]
        });

        infowindow = new google.maps.InfoWindow();

        // Mark the user’s location with a custom marker
        new google.maps.Marker({
            position: centerPos,
            map: map,
            icon: {
                url: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
            },
            title: "Your Location"
        });

        // Prepare the PlacesService
        service = new google.maps.places.PlacesService(map);

        // Perform a nearby search
        const request = {
            location: centerPos,
            radius: 3000,      // 3km radius (as a number, not a string)
            type: placeType    // 'police' or 'hospital'
        };

        service.nearbySearch(request, handleSearchResults);
    }

    function handleSearchResults(results, status) {
        const resultsContainer = document.getElementById('results');
        resultsContainer.innerHTML = ''; // clear initial placeholder

        if (status === google.maps.places.PlacesServiceStatus.OK && results && results.length > 0) {
            results.forEach(place => {
                createMarker(place);

                // Create a card-like element for each place
                const placeEl = document.createElement('div');
                placeEl.classList.add('p-3', 'border', 'rounded', 'bg-white');

                // Place Name
                const nameEl = document.createElement('h3');
                nameEl.classList.add('font-bold');
                nameEl.textContent = place.name || 'Unnamed Place';

                // Address (vicinity)
                const addrEl = document.createElement('div');
                addrEl.classList.add('text-sm', 'text-gray-700');
                addrEl.textContent = place.vicinity || '';

                // Placeholder for phone number
                const phoneEl = document.createElement('div');
                phoneEl.classList.add('text-sm', 'text-gray-600');
                phoneEl.textContent = 'Loading phone...';

                // A clickable "Call" button
                const callBtn = document.createElement('a');
                callBtn.classList.add(
                    'inline-block', 
                    'bg-green-600', 
                    'text-white', 
                    'px-3', 
                    'py-1', 
                    'rounded', 
                    'text-sm', 
                    'mt-2'
                );
                callBtn.textContent = 'Call';
                callBtn.href = '#'; // will update with phone number if found

                // Append to placeEl
                placeEl.appendChild(nameEl);
                placeEl.appendChild(addrEl);
                placeEl.appendChild(phoneEl);
                placeEl.appendChild(callBtn);

                // Append placeEl to the results container
                resultsContainer.appendChild(placeEl);

                // We do a separate details request to get phone number
                const detailsReq = {
                    placeId: place.place_id,
                    fields: ['formatted_phone_number', 'international_phone_number']
                };
                service.getDetails(detailsReq, (detailsResult, detailsStatus) => {
                    if (detailsStatus === google.maps.places.PlacesServiceStatus.OK && detailsResult) {
                        const phone = detailsResult.formatted_phone_number 
                                   || detailsResult.international_phone_number;
                        if (phone) {
                            phoneEl.textContent = phone;
                            callBtn.href = 'tel:' + phone; // so it can dial
                        } else {
                            phoneEl.textContent = 'No phone number found.';
                        }
                    } else {
                        phoneEl.textContent = 'No phone number found.';
                    }
                });
            });
        } else {
            // No results or an error
            resultsContainer.innerHTML = `
                <p class="text-red-500">
                    No nearby results found for “${placeType}”.
                </p>
            `;
        }
    }

    function createMarker(place) {
        if (!place.geometry || !place.geometry.location) return;

        const marker = new google.maps.Marker({
            map,
            position: place.geometry.location,
            icon: {
                url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
            }
        });

        google.maps.event.addListener(marker, 'click', () => {
            infowindow.setContent(place.name || 'Unnamed Place');
            infowindow.open(map, marker);
        });

        markers.push(marker);
    }
</script>
@endsection
