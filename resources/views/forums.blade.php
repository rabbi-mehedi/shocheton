@extends('layouts.user')
@section('page_title', 'আলোচনাস্হ | Forums')
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
                    <li><a href="{{ route('forums.index', ['category' => 'General']) }}" class="text-sm text-red-600 hover:underline">General</a></li>
                    <li><a href="{{ route('forums.index', ['category' => 'Advice']) }}" class="text-sm text-red-600 hover:underline">Advice</a></li>
                    <li><a href="{{ route('forums.index', ['category' => 'News']) }}" class="text-sm text-red-600 hover:underline">News</a></li>
                    <li><a href="{{ route('forums.index', ['category' => 'Support']) }}" class="text-sm text-red-600 hover:underline">Support</a></li>
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

            <!-- New Post Form -->
            <div id="newPostContainer" class="hidden transition-all duration-300">
                <form id="newPostForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="mb-6 border border-gray-300 p-4 rounded-lg bg-white shadow-sm">
                    @csrf
                    <textarea name="content" id="postContent" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 resize-none" rows="3" placeholder="Share your thoughts and experiences..."></textarea>
                    
                    <section class="flex justify-between w-full">
                        <div class="flex w-full">
                            <!-- File Attachment -->
                            <div class="mt-4">
                                <label for="attachment" class="hover:cursor-pointer block text-sm text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip">
                                        <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
                                    </svg>
                                </label>
                                <input type="file" name="attachment" id="attachment" class="hidden w-full mt-2 p-2 border border-gray-300 rounded-lg" accept="image/*, .pdf, .docx, .xlsx">
                            </div>
                            
                            <!-- Location Icon and Name -->
                            <div class="flex ml-3 mt-4">
                                <label for="location" id="findLocation" class="hover:cursor-pointer block text-sm text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </label>
                                <span id="locationText" class="ml-2 text-gray-700 text-sm">Location not selected</span>
                                <input type="hidden" name="location" id="location">
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">
                            </div>
                        </div>
                        <!-- Post Button -->
                        <div class="flex justify-end mt-2">
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Post</button>
                        </div>
                    </section>
                </form>
            </div>

            <!-- Threads Section -->
            <div id="posts" class="space-y-6">
                @foreach ($posts as $post)
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm" id="post-{{ $post->id }}">
                    <div class="flex items-center mb-3">
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" class="object-cover w-10 h-10 rounded-full mr-3" alt="User">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $post->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <p class="text-gray-800 mb-3">{!! nl2br(e($post->content)) !!}</p>

                    <!-- Voting -->
                    <div class="flex items-center gap-4 text-sm mb-3">
                        <div class="flex items-center space-x-1">
                            <button class="text-gray-600 hover:text-red-600" onclick="votePost({{ $post->id }}, 1, this)">⬆</button>
                            <span class="vote-count">
                                {{ $post->votes->where('vote', 1)->count() - $post->votes->where('vote', -1)->count() }}
                            </span>
                            <button class="text-gray-600 hover:text-blue-600" onclick="votePost({{ $post->id }}, -1, this)">⬇</button>
                        </div>
                        <button onclick="reportPost({{ $post->id }})" class="text-gray-500 hover:text-yellow-600">🚩 Report</button>
                    </div>

                    <!-- Comments Section -->
                    <div class="comments">
                        <button class="text-blue-600 hover:underline text-sm" onclick="toggleComments({{ $post->id }})">
                            View Comments ({{ $post->comments->count() }})
                        </button>
                        <div id="comments-{{ $post->id }}" class="hidden mt-4">
                            @foreach ($post->comments as $comment)
                            <div class="ml-4 mb-3 border-l-2 border-gray-300 pl-4">
                                <div class="flex items-center mb-1">
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" class="object-cover w-8 h-8 rounded-full mr-3" alt="User">
                                    <p class="font-medium text-sm text-gray-700">
                                        {{ $comment->user->name }} 
                                        <span class="text-xs text-gray-400">· {{ $comment->created_at->diffForHumans() }}</span>
                                    </p>
                                </div>
                                <p class="text-gray-700 mb-1">{{ $comment->content }}</p>
                            </div>
                            @endforeach

                            <!-- New Comment Form -->
                            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="ml-4 mt-4">
                                @csrf
                                <textarea name="content" class="w-full p-2 border border-gray-300 rounded-lg resize-none text-sm" rows="2" placeholder="Write a comment..."></textarea>
                                <div class="flex justify-end mt-1">
                                    <button type="submit" class="text-xs px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    // CSRF token for AJAX requests
    const csrfToken = '{{ csrf_token() }}';

    // Toggle new post form
    document.getElementById('togglePostForm').addEventListener('click', function() {
        const form = document.getElementById('newPostContainer');
        form.classList.toggle('hidden');
        if (!form.classList.contains('hidden')) {
            form.scrollIntoView({ behavior: 'smooth' });
        }
    });

    // Initialize Google Maps API for location selection
    let geocoder;
    function initMap() {
        geocoder = new google.maps.Geocoder();
    }

    // Retrieve user location and update the hidden inputs
    document.getElementById('findLocation').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;
                const latLng = new google.maps.LatLng(lat, lng);
                geocoder.geocode({ 'location': latLng }, function(results, status) {
                    if (status === 'OK' && results[0]) {
                        const address = results[0].formatted_address;
                        document.getElementById('locationText').innerText = address;
                        document.getElementById('location').value = address;
                    } else {
                        alert('Unable to retrieve address.');
                    }
                });
            }, function() {
                alert('Unable to retrieve your location');
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    });

    // Vote on a post (AJAX call)
    function votePost(postId, voteValue, btn) {
        fetch(`/posts/${postId}/vote`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ vote: voteValue })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the displayed vote count using the difference between upvotes and downvotes.
                const voteCountElem = btn.parentElement.querySelector('.vote-count');
                voteCountElem.textContent = data.upvotes - data.downvotes;
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Toggle comments for a post
    function toggleComments(postId) {
        const commentsDiv = document.getElementById('comments-' + postId);
        commentsDiv.classList.toggle('hidden');
    }

    // Placeholder for report functionality
    function reportPost(postId) {
        alert('Post ' + postId + ' reported.');
    }
</script>

<!-- Google Maps API -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap"></script>
@endsection
