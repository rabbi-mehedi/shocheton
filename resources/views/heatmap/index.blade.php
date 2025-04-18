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

    <!-- Statistics Dashboard -->
    <div class="w-full max-w-5xl bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Offense Statistics</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Total Incidents Card -->
            <div class="bg-red-50 rounded-lg p-4 shadow-sm border border-red-100">
                <h3 class="text-sm font-semibold text-gray-600">Total Reported Incidents</h3>
                <div class="mt-2 flex items-baseline">
                    <p class="text-2xl font-bold text-red-700">{{ array_sum(array_column($geocodedData, 'count')) }}</p>
                    <span class="ml-2 text-xs text-gray-500">incidents</span>
                </div>
            </div>
            
            <!-- Hotspot Locations Card -->
            <div class="bg-red-50 rounded-lg p-4 shadow-sm border border-red-100">
                <h3 class="text-sm font-semibold text-gray-600">Hotspot Locations</h3>
                <div class="mt-2 flex items-baseline">
                    <p class="text-2xl font-bold text-red-700">{{ count($geocodedData) }}</p>
                    <span class="ml-2 text-xs text-gray-500">locations</span>
                </div>
            </div>
            
            <!-- Highest Concentration Card -->
            <div class="bg-red-50 rounded-lg p-4 shadow-sm border border-red-100">
                <h3 class="text-sm font-semibold text-gray-600">Highest Concentration</h3>
                <div class="mt-2 flex items-baseline">
                    @php
                        $maxCount = !empty($geocodedData) ? max(array_column($geocodedData, 'count')) : 0;
                    @endphp
                    <p class="text-2xl font-bold text-red-700">{{ $maxCount }}</p>
                    <span class="ml-2 text-xs text-gray-500">incidents in one area</span>
                </div>
            </div>
            
            <!-- Average Incidents Card -->
            <div class="bg-red-50 rounded-lg p-4 shadow-sm border border-red-100">
                <h3 class="text-sm font-semibold text-gray-600">Average per Location</h3>
                <div class="mt-2 flex items-baseline">
                    @php
                        $avgCount = !empty($geocodedData) ? round(array_sum(array_column($geocodedData, 'count')) / count($geocodedData), 1) : 0;
                    @endphp
                    <p class="text-2xl font-bold text-red-700">{{ $avgCount }}</p>
                    <span class="ml-2 text-xs text-gray-500">incidents avg</span>
                </div>
            </div>
        </div>
        
        <!-- Incident Density Chart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
            <h3 class="text-sm font-semibold text-gray-600 mb-3">Incident Density Distribution</h3>
            <div class="w-full h-40" id="density-chart">
                <!-- Canvas will be created by Chart.js -->
            </div>
        </div>
        
        <!-- Top Hotspots Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <h3 class="text-sm font-semibold text-gray-600 mb-3">Top 5 Hotspot Locations</h3>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Incidents</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Severity</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="hotspot-table-body">
                        <!-- Table rows will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
            
            <p class="text-xs text-gray-500 mt-2">Click on any row to center the map on that location</p>
        </div>
    </div>

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
        <div id="map" style="height: 700px; width: 1100px;"></div>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        // Initialize array to store circle references
        const locationCircles = [];

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
            geocodedData.forEach((loc, index) => {
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

                // Store circle reference with its data
                locationCircles.push({
                    circle: circle,
                    data: loc
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

        // Create density chart
        createDensityChart(geocodedData);
        
        // Create hotspot table
        createHotspotTable(geocodedData, map, locationCircles);
    }

    // Create density chart
    function createDensityChart(data) {
        // Group data into categories for visualization
        const categories = [
            {label: '1-5', count: 0, color: 'rgba(255, 226, 226, 0.7)'},
            {label: '6-10', count: 0, color: 'rgba(255, 170, 170, 0.7)'},
            {label: '11-20', count: 0, color: 'rgba(255, 119, 119, 0.7)'},
            {label: '21-50', count: 0, color: 'rgba(255, 51, 51, 0.7)'},
            {label: '51+', count: 0, color: 'rgba(204, 0, 0, 0.7)'}
        ];

        // Count locations in each category
        data.forEach(loc => {
            const count = loc.count;
            
            if (count <= 5) categories[0].count++;
            else if (count <= 10) categories[1].count++;
            else if (count <= 20) categories[2].count++;
            else if (count <= 50) categories[3].count++;
            else categories[4].count++;
        });

        // Create canvas element for chart
        const canvas = document.createElement('canvas');
        document.getElementById('density-chart').appendChild(canvas);

        // Create chart
        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: categories.map(c => c.label + ' incidents'),
                datasets: [{
                    label: 'Number of Locations',
                    data: categories.map(c => c.count),
                    backgroundColor: categories.map(c => c.color),
                    borderColor: categories.map(c => c.color.replace('0.7', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.raw} locations`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }

    // Create hotspot table
    function createHotspotTable(data, map, locationCircles) {
        // Sort data by count in descending order
        const sortedData = [...data].sort((a, b) => b.count - a.count);
        
        // Get top 5 (or less if fewer locations exist)
        const top5 = sortedData.slice(0, 5);
        
        const tableBody = document.getElementById('hotspot-table-body');
        
        // Create table rows for top locations
        top5.forEach((loc, index) => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-100 cursor-pointer';
            
            // Add rank
            const rankCell = document.createElement('td');
            rankCell.className = 'px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900';
            rankCell.textContent = index + 1;
            row.appendChild(rankCell);
            
            // Add location
            const locationCell = document.createElement('td');
            locationCell.className = 'px-6 py-4 whitespace-nowrap text-sm text-gray-500';
            locationCell.textContent = `${loc.latitude.toFixed(4)}, ${loc.longitude.toFixed(4)}`;
            row.appendChild(locationCell);
            
            // Add count
            const countCell = document.createElement('td');
            countCell.className = 'px-6 py-4 whitespace-nowrap text-sm text-gray-500';
            countCell.textContent = loc.count;
            row.appendChild(countCell);
            
            // Add severity
            const severityCell = document.createElement('td');
            severityCell.className = 'px-6 py-4 whitespace-nowrap';
            
            // Create severity indicator based on count
            let severity, bgColor;
            if (loc.count <= 5) {
                severity = 'Low';
                bgColor = 'bg-yellow-100 text-yellow-800';
            } else if (loc.count <= 15) {
                severity = 'Medium';
                bgColor = 'bg-orange-100 text-orange-800';
            } else {
                severity = 'High';
                bgColor = 'bg-red-100 text-red-800';
            }
            
            const badge = document.createElement('span');
            badge.className = `px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${bgColor}`;
            badge.textContent = severity;
            severityCell.appendChild(badge);
            row.appendChild(severityCell);
            
            // Add click handler to center map on location
            row.addEventListener('click', () => {
                const center = {
                    lat: parseFloat(loc.latitude),
                    lng: parseFloat(loc.longitude)
                };
                
                map.setCenter(center);
                map.setZoom(15);
                
                // Find and highlight the corresponding circle if available
                if (locationCircles.length > 0) {
                    const matchingCircle = locationCircles.find(
                        item => item.data.latitude === loc.latitude && 
                        item.data.longitude === loc.longitude
                    );
                    
                    if (matchingCircle) {
                        // Briefly animate the circle to highlight it
                        const originalOpacity = matchingCircle.circle.get('fillOpacity');
                        matchingCircle.circle.set('fillOpacity', 0.8);
                        
                        setTimeout(() => {
                            matchingCircle.circle.set('fillOpacity', originalOpacity);
                        }, 2000);
                    }
                }
            });
            
            tableBody.appendChild(row);
        });
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
