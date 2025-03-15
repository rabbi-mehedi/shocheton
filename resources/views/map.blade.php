{{-- resources/views/emergency/index.blade.php --}}
@extends('layouts.user')

@section('page_title', 'Emergency Alerts')

@section('page_content')

    <div class="container">
        <h1>Emergency Alerts</h1>

        <button id="alertBtn" class="bg-red-600 text-white px-4 py-2 rounded">
            Send Emergency Alert
        </button>

        <div id="map" style="width: 100%; height: 500px; margin-top: 1rem;"></div>
    </div>

    {{-- Google Maps JS (replace YOUR_API_KEY) --}}
    <script async
    defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdSsNxBZzj0YHjJlulOmiKqF1VsA0HZFs&callback=initMap">
    </script>

    <script>
        // We'll embed existing alerts from the server in a JS variable.
        const existingAlerts = @json($alerts);

        // This function is called automatically once Google Maps script loads
        function initMap() {
            // Center map on some default location (e.g., Dhaka)
            const mapCenter = { lat: 23.8103, lng: 90.4125 };

            const map = new google.maps.Map(document.getElementById('map'), {
                center: mapCenter,
                zoom: 12,
            });

            // Place markers for existing alerts
            existingAlerts.forEach(alert => {
                new google.maps.Marker({
                    position: {
                        lat: parseFloat(alert.lat),
                        lng: parseFloat(alert.lng)
                    },
                    map: map,
                    icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                    title: 'Emergency Alert'
                });
            });
        }

        // Capture geolocation on button click, then POST to store route
        document.getElementById('alertBtn').addEventListener('click', () => {
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
    </script>
@endsection
