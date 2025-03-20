{{-- resources/views/emergency/index.blade.php --}}
@extends('layouts.user')

@section('page_title', 'Emergency Alerts')

@section('page_content')
<div id="desktop-content" style="display:none;" class="text-center mt-12">
    <h2 class="text-xl font-bold mb-4">We currently do not support desktop view.</h2>
    <p class="text-gray-600">Please use a tablet or mobile device to access this feature.</p>
</div>

<div id="mobile-content" style="display:none;">
    <div class="container mx-auto mt-6 px-4">
        {{-- Personalized user info (assuming you're using Auth::user()) --}}
        <h1 class="md:text-2xl text-xl font-bold text-gray-900 mb-4">
            Welcome to সচেতন Map @if (auth()->user())
            <br>{{ auth()->user()->name }}
            @else
                
            @endif
        </h1>

        <h2 class="text-xl font-bold text-gray-700 mb-2">Emergency Alerts</h2>
        <section class="flex flex-col">
            <small class="uppercase font-semibold text-gray-500">Locate your nearest :</small>
            <div class="flex mt-3">
                <a 
                  href="{{ route('emergency.locate', ['type' => 'police']) }}" 
                  class="px-3 py-2 font-bold text-sm mr-2 uppercase text-gray-400 border-box border-2 rounded-full border-gray-500 hover:border-red-600"
                >
                    Police Station
                </a>
                <a 
                  href="{{ route('emergency.locate', ['type' => 'hospital']) }}" 
                  class="px-3 py-2 font-bold text-sm mx-2 uppercase text-gray-400 border-box border-2 rounded-full border-gray-500 hover:border-red-600"
                >
                    Hospital
                </a>
            </div>
        </section>
        
        

        {{-- Map container --}}
        <div id="map" class="w-full h-64 sm:h-96 mt-4 border border-gray-300 rounded"></div>
            {{-- Button to send an alert --}}
            <button id="alertBtn" @guest
                disabled
            @endguest class="@guest
                bg-gray-400
            @endguest @auth
                bg-red-600
            @endauth w-full font-bold text-white px-4 py-2 rounded">
                SEND EMERGENCY ALERT
            </button>
            @auth
            <div class="mt-4 flex items-center">
                <input 
                    type="checkbox" 
                    id="alertEmergencyContacts" 
                    name="alertEmergencyContacts" 
                    value="1" 
                    class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded"
                />
                <label for="alertEmergencyContacts" class="ml-2 text-sm text-gray-700">
                    Alert all of my emergency contacts
                </label>
            </div>
            @endauth
            @guest
            <label for="alertEmergencyContacts" class="text-sm text-gray-700 ">You need to have a সচেতন Account<br>to use this feature. <a href="{{route('register')}}" class="text-red-700 font-bold">Sign Up</a></label>
            @endguest
    
            {{-- List of alerts (most recent first) --}}
            <h3 class="text-lg font-semibold text-gray-800 mt-6">Recent Alerts</h3>
            <ul class="mt-2 space-y-2">
                @forelse($alerts as $alert)
                    <li class="p-2 border-b border-gray-200 flex items-center justify-between">
                        <div>
                            <strong>Alert #{{ $alert->id }}</strong> 
                            <span class="text-sm text-gray-600">
                                ({{ $alert->created_at->format('d M Y, h:i A') }})
                            </span>
                            <div class="text-sm text-gray-800">
                                Location: lat {{ $alert->lat }}, lng {{ $alert->lng }}
                            </div>
                        </div>

                        {{-- If user is admin, show delete button --}}
                        @if(auth()->user() && auth()->user()->isAdmin())
                            <form 
                                action="{{ route('emergency.destroy', $alert->id) }}" 
                                method="POST" 
                                onsubmit="return confirm('Are you sure you want to delete this alert?');"
                            >
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600"
                                >
                                    Delete
                                </button>
                            </form>
                        @endif
                    </li>
                @empty
                    <li class="text-sm text-gray-500">No alerts yet.</li>
                @endforelse
            </ul>
        </div>
        {{-- Checkbox to confirm alerting emergency contacts --}}

</div>

{{-- Google Maps JS (replace YOUR_API_KEY) --}}
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdSsNxBZzj0YHjJlulOmiKqF1VsA0HZFs&map_ids=f96874cf6e8badfa&callback=initMap"
    async
    defer
></script>

<script>
    // 1) Hide or show content based on user agent
    document.addEventListener('DOMContentLoaded', () => {
      const isMobile = /Mobi|Android|Tablet|iPad|iPhone/i.test(navigator.userAgent);
      if (isMobile) {
        document.getElementById('mobile-content').style.display = 'block';
      } else {
        document.getElementById('desktop-content').style.display = 'block';
      }
    });

    // 2) We'll embed existing alerts from the server in a JS variable.
    const existingAlerts = @json($alerts->toArray());

    // 3) initMap function for Google Maps callback
    function initMap() {
        // Default center (e.g., Dhaka)
        const mapCenter = { lat: 23.8103, lng: 90.4125 };

        // Create the map
        const map = new google.maps.Map(document.getElementById('map'), {
            center: mapCenter,
            zoom: 12,
            mapId: "f96874cf6e8badfa",
        });

        // Place blinking markers for existing alerts
        existingAlerts.forEach(alert => {
            new google.maps.Marker({
                position: {
                    lat: parseFloat(alert.lat),
                    lng: parseFloat(alert.lng)
                },
                map: map,
                // Provide a blinking GIF or animated marker
                icon: {
                  url: '/blink-dot.gif', // <--- Replace with your actual path or URL
                  scaledSize: new google.maps.Size(32, 32),
                },
                title: `Emergency Alert (ID: ${alert.id})`
            });
        });
    }

    // 4) Geolocation logic on button click
    document.addEventListener('DOMContentLoaded', () => {
        const alertBtn = document.getElementById('alertBtn');
        if (alertBtn) {
            alertBtn.addEventListener('click', () => {
                if (!navigator.geolocation) {
                    alert('Geolocation is not supported by your browser.');
                    return;
                }

                navigator.geolocation.getCurrentPosition(
                    position => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        // Send lat/lng to our store route
                        fetch("{{ route('emergency.store') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({ lat, lng })
                        })
                        .then(res => res.json())
                        .then(data => {
                            alert('Emergency Alert Sent!');
                            // Reload to see new marker (or add marker dynamically)
                            location.reload();
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Error sending alert.');
                        });
                    },
                    error => {
                        console.error('Geolocation error:', error);
                        alert('Could not get your location.');
                    },
                    { enableHighAccuracy: true, timeout: 15000 }
                );
            });
        }
    });
</script>
@endsection
