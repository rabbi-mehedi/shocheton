@extends('layouts.user')
@section('page_title','আলোচনাস্হ | Forums')
@section('page_content')

<div class="w-full flex justify-center flex-col items-center">
    <!-- Logo -->
    <a href="{{ route('home') }}">
        <img src="{{ asset('wide_logo.png') }}" alt="shocheton.org" class="my-6 h-[10vh]">
    </a>

    <!-- Header -->
    <header class="bg-red-600 text-white py-4">
        <div class="container mx-auto px-4 max-w-5xl flex flex-col md:flex-row items-center justify-center">
            <h1 class="text-2xl md:text-3xl font-bold uppercase tracking-wide md:tracking-wider leading-tight text-center md:text-left">
                আলোচনাস্হ | Forums
            </h1>
        </div>
    </header>

    <!-- Thread Layout -->
    <div class="container mx-auto px-4 py-6 max-w-5xl flex flex-col md:flex-row gap-4">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-full md:w-1/4 mb-6 md:mb-0">
            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                <h2 class="text-lg font-semibold mb-2 hidden md:block">Categories</h2>
                <ul id="categoryList" class="space-y-2">
                    <li><a href="#" class="text-sm text-red-600 hover:underline">General</a></li>
                    <li><a href="#" class="text-sm text-red-600 hover:underline">Advice</a></li>
                    <li><a href="#" class="text-sm text-red-600 hover:underline">News</a></li>
                    <li><a href="#" class="text-sm text-red-600 hover:underline">Support</a></li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="w-full md:w-3/4">
            <!-- Create New Post Button -->
            <div class="flex justify-end mb-4">
                <button id="togglePostForm" class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg transition">
                    <span class="text-xl mr-2">+</span>Start a New Thread
                </button>
            </div>

            <!-- Hidden New Post Form -->
            <div id="newPostContainer" class="hidden transition-all duration-300">
                <div id="newPost" class="mb-6 border border-gray-300 p-4 rounded-lg bg-white shadow-sm">
                    <!-- Textarea for Post Content -->
                    <textarea id="postContent" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 resize-none" rows="3" placeholder="Share your thoughts and experiences..."></textarea>
                    
                    <section class="flex justify-between w-full">
                        <div class="flex w-full">
                        <!-- File Attachment -->
                            <div class="mt-4">
                                <label for="attachment" class="hover:cursor-pointer block text-sm text-gray-700"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg></label>
                                <input type="file" id="attachment" class="hidden w-full mt-2 p-2 border border-gray-300 rounded-lg" accept="image/*, .pdf, .docx, .xlsx">
                            </div>
                            
                            <!-- Location Icon and Location Name -->
                            <div class="flex ml-3 mt-4">
                                <label for="location" id="findLocation" class="hover:cursor-pointer block text-sm text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </label>
                                <span id="locationText" class="ml-2 text-gray-700 text-sm">Location not selected</span>
                                <!-- Hidden Location Input (just for saving lat/lng) -->
                                <input type="hidden" id="location" name="location">
                                <input type="hidden" id="lat" name="lat">
                                <input type="hidden" id="lng" name="lng">
                            </div>
                        </div>
                        <!-- Post Button -->
                        <div class="flex justify-end mt-2">
                            <button onclick="createPost()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Post</button>
                        </div>              
                    </section>
                    
                </div>
            </div>

            <!-- Threads Section -->
            <div id="posts" class="space-y-6">
                <!-- Example Thread -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center mb-3">
                        <img src="{{ asset('60111.jpg') }}" class="object-cover w-10 h-10 rounded-full mr-3" alt="User">
                        <div>
                            <p class="font-semibold text-gray-800">John Doe</p>
                            <p class="text-xs text-gray-500">Posted 2 hours ago</p>
                        </div>
                    </div>
                    <p class="text-gray-800 mb-3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                        <br><br>
                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                    </p>

                    <!-- Report/Flag Upvote/Downvote -->
                    <div class="flex items-center gap-4 text-sm mb-3">
                        <div class="flex items-center space-x-1">
                            <button onclick="upvote(this)" class="text-gray-600 hover:text-red-600">⬆</button>
                            <span class="vote-count">0</span>
                            <button onclick="downvote(this)" class="text-gray-600 hover:text-blue-600">⬇</button>
                        </div>
                        <button onclick="report(this)" class="text-gray-500 hover:text-yellow-600">🚩 Report</button>
                    </div>

                    <!-- View Comments Dropdown -->
                    <div class="mt-4 flex items-center space-x-1 cursor-pointer text-blue-600 hover:underline text-sm" onclick="toggleComments(this)">
                        <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                        <span>View Comments (3)</span>
                    </div>

                    <!-- Comments Section (hidden by default) -->
                    <div class="hidden space-y-4 ml-4 border-l-2 border-gray-300 pl-4 comments-thread">
                        <div>
                            <div class="flex items-center mb-1">
                                <img src="{{ asset('60111.jpg') }}" class="object-cover w-10 h-10 rounded-full mr-3" alt="User">
                                <p class="font-medium text-sm text-gray-700">Jane Smith <span class="text-xs text-gray-400">· 1 hour ago</span></p>
                            </div>
                            <p class="text-gray-700 mb-1 ml-10">This is a comment on the thread.</p>
                            <div class="ml-10 mb-2">
                                <button onclick="toggleReplies(this)" class="text-xs text-blue-600 hover:underline">View Replies (1)</button>
                            </div>

                            <div class="ml-10 hidden space-y-3 replies-container">
                                <div class="border-l-2 border-gray-200 pl-4">
                                    <div class="flex items-center mb-1">
                                    <img src="{{ asset('60111.jpg') }}" class="object-cover w-10 h-10 rounded-full mr-3" alt="User">
                                        <p class="font-medium text-sm text-gray-700">Alice <span class="text-xs text-gray-400">· 30 min ago</span></p>
                                    </div>
                                    <p class="text-gray-600 mb-1 ml-10">This is a reply to the comment.</p>
                                </div>

                                <div class="mt-2 ml-4">
                                    <textarea class="w-full p-2 border border-gray-300 rounded-lg resize-none text-sm" rows="2" placeholder="Write a reply..."></textarea>
                                    <div class="flex justify-end mt-1">
                                        <button class="text-xs px-3 py-1 bg-red-600 text-white rounded hover:bg-red-600">Reply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comment Input -->
                    <div class="hidden mt-4 comments-thread">
                        <textarea class="w-full p-2 border border-gray-300 rounded-lg resize-none text-sm" rows="2" placeholder="Write a comment..."></textarea>
                        <div class="flex justify-end mt-1">
                            <button class="text-xs px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Comment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Cosmetic JS -->
<script>
    // Initialize Google Maps API
    let map, geocoder, marker;
    function initMap() {
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 23.8103, lng: 90.4125 }, // Default to Dhaka, Bangladesh
            zoom: 12,
        });
    }

    // Get the user's current location and show the human-readable address
    document.getElementById('findLocation').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;

                // Use Google Maps Geocoding API to get human-readable address
                const latLng = new google.maps.LatLng(lat, lng);
                geocoder.geocode({ 'location': latLng }, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            const address = results[0].formatted_address;
                            // Update location text next to the icon
                            document.getElementById('locationText').innerText = address;
                            // Optionally store the address in the hidden input field
                            document.getElementById('location').value = address;
                        } else {
                            alert('No results found for the location.');
                        }
                    } else {
                        alert('Geocoder failed due to: ' + status);
                    }
                });
            }, function() {
                alert('Unable to retrieve your location');
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    });


    // Create Post Function
    function createPost() {
        const content = document.getElementById('postContent').value.trim();
        const attachment = document.getElementById('attachment').files[0];
        const location = document.getElementById('location').value;
        const lat = document.getElementById('lat').value;
        const lng = document.getElementById('lng').value;

        if (!content) return alert('Please write something before posting!');
        
        // Placeholder alert for post creation
        alert('Post created (placeholder functionality).');

        // Handle file upload (if any) and location
        if (attachment) {
            // Upload the file (add your backend upload logic here)
            alert(`File uploaded: ${attachment.name}`);
        }

        if (lat && lng) {
            alert(`Location: Latitude - ${lat}, Longitude - ${lng}`);
        }
    }

    function upvote(btn) {
        const count = btn.nextElementSibling;
        count.textContent = parseInt(count.textContent) + 1;
    }

    function downvote(btn) {
        const count = btn.previousElementSibling;
        count.textContent = parseInt(count.textContent) - 1;
    }

    function reportComment() {
        alert('This comment has been flagged for review.');
    }

    function toggleReplies(button) {
        const repliesContainer = button.parentElement.nextElementSibling;
        repliesContainer.classList.toggle('hidden');
        if (repliesContainer.classList.contains('hidden')) {
            button.textContent = 'View Replies (1)';
        } else {
            button.textContent = 'Hide Replies';
        }
    }

    function toggleComments(el) {
        const icon = el.querySelector('svg');
        const commentThread = el.nextElementSibling;
        const inputBox = commentThread.nextElementSibling;

        commentThread.classList.toggle('hidden');
        inputBox.classList.toggle('hidden');

        if (commentThread.classList.contains('hidden')) {
            icon.style.transform = 'rotate(0deg)';
            el.querySelector('span').innerText = 'View Comments (3)';
        } else {
            icon.style.transform = 'rotate(180deg)';
            el.querySelector('span').innerText = 'Hide Comments';
        }
    }

    document.getElementById('togglePostForm').addEventListener('click', function() {
        const form = document.getElementById('newPostContainer');
        form.classList.toggle('hidden');
        // Optional: scroll to form after showing
        if (!form.classList.contains('hidden')) {
            form.scrollIntoView({ behavior: 'smooth' });
        }
    });
    </script>

    <!-- Add the Google Maps API -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdSsNxBZzj0YHjJlulOmiKqF1VsA0HZFs&callback=initMap"></script>

</script>

@endsection
