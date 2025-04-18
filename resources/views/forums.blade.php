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
                <ul id="sidebarCategoryList" class="space-y-2">
                    <li><a href="{{ route('forums.index') }}" class="text-sm {{ !request('category') ? 'font-bold text-red-700' : 'text-red-600' }} hover:underline">All Categories</a></li>
                    @php
                        $categories = \App\Models\Post::select('category')
                            ->distinct()
                            ->whereNotNull('category')
                            ->pluck('category');
                    @endphp
                    @foreach($categories as $category)
                    <li><a href="{{ route('forums.index', ['category' => $category]) }}" class="text-sm {{ request('category') == $category ? 'font-bold text-red-700' : 'text-red-600' }} hover:underline">{{ $category }}</a></li>
                    @endforeach
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

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission:</h3>
                        <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Authentication Notice -->
            @guest
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            You need to <a href="{{ route('login') }}" class="font-medium underline text-blue-700 hover:text-blue-600">log in</a> or <a href="{{ route('register') }}" class="font-medium underline text-blue-700 hover:text-blue-600">create an account</a> to post in the forums.
                        </p>
                    </div>
                </div>
            </div>
            @endguest

            <!-- New Post Form -->
            <div id="newPostContainer" class="hidden transition-all duration-300">
                <form id="newPostForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="mb-6 border border-gray-300 p-4 rounded-lg bg-white shadow-sm">
                    @csrf
                    <textarea name="content" id="postContent" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 resize-none" rows="3" placeholder="Share your thoughts and experiences..."></textarea>
                    
                    <!-- Category Selection -->
                    <div class="mt-2">
                        <label for="category" class="text-sm text-gray-700">Category (optional):</label>
                        <div class="flex items-center">
                            <input type="text" name="category" id="categoryInput" list="categoryDropdown" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" placeholder="Select or create a new category">
                            <datalist id="categoryDropdown">
                                @foreach($categories as $category)
                                    <option value="{{ $category }}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    
                    <!-- Anonymous Option -->
                    <div class="mt-3">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="anonymous" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Keep me anonymous</span>
                        </label>
                    </div>
                    
                    <section class="flex justify-between w-full mt-2">
                        <div class="flex w-full">
                            <!-- Multiple Media Upload -->
                            <div class="mt-4 relative">
                                <label for="media-upload" class="hover:cursor-pointer block text-sm text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip">
                                        <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
                                    </svg>
                                    <span id="media-count" class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center hidden">0</span>
                                </label>
                                <input type="file" name="media[]" id="media-upload" class="hidden" multiple accept="image/*, video/*, audio/*, application/pdf, .doc, .docx, .xlsx">
                                <div id="file-preview" class="hidden mt-2 p-2 border border-gray-200 rounded-lg bg-gray-50"></div>
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
                @if($posts->isEmpty())
                    <div class="bg-white border border-gray-200 rounded-lg p-8 shadow-sm text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">No discussions yet</h3>
                        <p class="text-gray-600 mb-4">Be the first to start a discussion in this community!</p>
                        <button id="startFirstPost" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Start a New Thread</button>
                    </div>
                @else
                    @foreach ($posts as $post)
                    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm" id="post-{{ $post->id }}">
                        <div class="flex items-center mb-2">
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" class="object-cover w-10 h-10 rounded-full mr-3" alt="User">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $post->getAuthorDisplayName() }}</p>
                                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <!-- Category Tag -->
                        @if($post->category)
                        <div class="mb-2">
                            <span class="inline-block bg-red-100 text-red-700 text-xs font-semibold px-2 py-1 rounded-full">
                                {{ $post->category }}
                            </span>
                        </div>
                        @endif
                        
                        <p class="text-gray-800 mb-3">{!! nl2br(e($post->content)) !!}</p>

                        <!-- Media Attachments -->
                        @if($post->getMedia('images')->count() > 0 || $post->getMedia('videos')->count() > 0 || $post->getMedia('audio')->count() > 0 || $post->getMedia('documents')->count() > 0)
                        <div class="media-container mb-4">
                            <!-- Images Gallery -->
                            @if($post->getMedia('images')->count() > 0)
                            <div class="images-gallery grid grid-cols-2 md:grid-cols-3 gap-2 mb-3">
                                @foreach($post->getMedia('images') as $image)
                                <a href="{{ $image->getUrl() }}" target="_blank" class="block">
                                    <img src="{{ $image->getUrl() }}" alt="Image attachment" class="w-full h-32 object-cover rounded-md hover:opacity-90 transition">
                                </a>
                                @endforeach
                            </div>
                            @endif

                            <!-- Videos -->
                            @if($post->getMedia('videos')->count() > 0)
                            <div class="videos-container space-y-3 mb-3">
                                @foreach($post->getMedia('videos') as $video)
                                <div class="video-wrapper">
                                    <video controls class="w-full rounded-md" preload="metadata">
                                        <source src="{{ $video->getUrl() }}" type="{{ $video->mime_type }}">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                @endforeach
                            </div>
                            @endif

                            <!-- Audio -->
                            @if($post->getMedia('audio')->count() > 0)
                            <div class="audio-container space-y-2 mb-3">
                                @foreach($post->getMedia('audio') as $audio)
                                <div class="audio-wrapper bg-gray-100 rounded-md p-2">
                                    <audio controls class="w-full">
                                        <source src="{{ $audio->getUrl() }}" type="{{ $audio->mime_type }}">
                                        Your browser does not support the audio tag.
                                    </audio>
                                </div>
                                @endforeach
                            </div>
                            @endif

                            <!-- Documents -->
                            @if($post->getMedia('documents')->count() > 0)
                            <div class="documents-container grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @foreach($post->getMedia('documents') as $document)
                                <a href="{{ $document->getUrl() }}" target="_blank" class="flex items-center p-2 bg-gray-100 rounded-md hover:bg-gray-200 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm text-gray-700 truncate">{{ $document->file_name }}</span>
                                </a>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- Voting and actions -->
                        <div class="flex items-center gap-4 text-sm mb-3">
                            <div class="flex items-center space-x-1">
                                <button class="text-gray-600 hover:text-red-600" onclick="votePost({{ $post->id }}, 1, this)" aria-label="Upvote post {{ $post->id }}">⬆</button>
                                <span class="upvote-count text-green-600 font-semibold">
                                    {{ $post->votes->where('vote', 1)->count() }}
                                </span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <button class="text-gray-600 hover:text-blue-600" onclick="votePost({{ $post->id }}, -1, this)" aria-label="Downvote post {{ $post->id }}">⬇</button>
                                <span class="downvote-count text-red-600 font-semibold">
                                    {{ $post->votes->where('vote', -1)->count() }}
                                </span>
                            </div>
                            <button onclick="reportPost({{ $post->id }})" class="text-gray-500 hover:text-yellow-600" aria-label="Report post {{ $post->id }}">🚩 Report</button>
                            @if (auth()->check() && auth()->user()->id == $post->user->id)
                                <button onclick="confirmDeletePost({{ $post->id }})" class="text-gray-500 hover:text-red-600" aria-label="Delete post {{ $post->id }}">🗑️ Delete</button>
                            @endif
                        </div>

                        <!-- Comments Section -->
                        <div class="comments">
                            <button class="text-blue-600 hover:underline text-sm" onclick="toggleComments({{ $post->id }})">
                                View Comments ({{ $post->allComments->count() }})
                            </button>
                            <div id="comments-{{ $post->id }}" class="hidden mt-4">
                                @if($post->comments->isEmpty())
                                    <p class="ml-4 text-sm text-gray-500 italic">No comments yet. Be the first to comment!</p>
                                @else
                                    @foreach ($post->comments as $comment)
                                    <div class="ml-4 mb-3 border-l-2 border-gray-300 pl-4" id="comment-{{ $comment->id }}">
                                        <div class="flex items-center mb-1">
                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" class="object-cover w-8 h-8 rounded-full mr-3" alt="User">
                                            <p class="font-medium text-sm text-gray-700">
                                                {{ $comment->user->name }} 
                                                <span class="text-xs text-gray-400">· {{ $comment->created_at->diffForHumans() }}</span>
                                            </p>
                                        </div>
                                        <p class="text-gray-700 mb-1">{{ $comment->content }}</p>
                                        
                                        <!-- Comment voting and actions -->
                                        <div class="flex items-center gap-4 text-xs my-1">
                                            <div class="flex items-center space-x-1">
                                                <button class="text-gray-600 hover:text-red-600" onclick="voteComment({{ $comment->id }}, 1, this)" aria-label="Upvote comment {{ $comment->id }}">⬆</button>
                                                <span class="upvote-count text-green-600 font-semibold">
                                                    {{ $comment->votes->where('vote', 1)->count() ?? 0 }}
                                                </span>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <button class="text-gray-600 hover:text-blue-600" onclick="voteComment({{ $comment->id }}, -1, this)" aria-label="Downvote comment {{ $comment->id }}">⬇</button>
                                                <span class="downvote-count text-red-600 font-semibold">
                                                    {{ $comment->votes->where('vote', -1)->count() ?? 0 }}
                                                </span>
                                            </div>
                                            <button class="text-xs text-gray-500 hover:text-blue-600" onclick="toggleReplyForm({{ $comment->id }})">Reply</button>
                                        </div>
                                        
                                        <!-- Reply form -->
                                        <div id="reply-form-{{ $comment->id }}" class="hidden ml-4 mt-2 mb-2">
                                            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="reply-form">
                                                @csrf
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <textarea name="content" class="w-full p-2 border border-gray-300 rounded-lg resize-none text-sm" rows="2" placeholder="Write a reply..."></textarea>
                                                <div class="flex justify-end mt-1">
                                                    <button type="submit" class="text-xs px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Reply</button>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <!-- Replies -->
                                        @if($comment->replies->count() > 0)
                                        <div class="mt-2">
                                            @foreach($comment->replies as $reply)
                                            <div class="ml-5 mt-2 border-l-2 border-gray-200 pl-3" id="reply-{{ $reply->id }}">
                                                <div class="flex items-center">
                                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" class="object-cover w-6 h-6 rounded-full mr-2" alt="User">
                                                    <p class="font-medium text-xs text-gray-700">
                                                        {{ $reply->user->name }}
                                                        <span class="text-xs text-gray-400">· {{ $reply->created_at->diffForHumans() }}</span>
                                                    </p>
                                                </div>
                                                <p class="text-sm text-gray-700 ml-8 mb-1">{{ $reply->content }}</p>
                                                
                                                <!-- Reply voting -->
                                                <div class="flex items-center gap-3 text-xs ml-8 mt-1">
                                                    <div class="flex items-center space-x-1">
                                                        <button class="text-gray-600 hover:text-red-600" onclick="voteComment({{ $reply->id }}, 1, this)" aria-label="Upvote reply {{ $reply->id }}">⬆</button>
                                                        <span class="upvote-count text-green-600 font-semibold">
                                                            {{ $reply->votes->where('vote', 1)->count() ?? 0 }}
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center space-x-1">
                                                        <button class="text-gray-600 hover:text-blue-600" onclick="voteComment({{ $reply->id }}, -1, this)" aria-label="Downvote reply {{ $reply->id }}">⬇</button>
                                                        <span class="downvote-count text-red-600 font-semibold">
                                                            {{ $reply->votes->where('vote', -1)->count() ?? 0 }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                @endif

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

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    // CSRF token for AJAX requests
    const csrfToken = '{{ csrf_token() }}';

    // File Upload and Preview
    const mediaUpload = document.getElementById('media-upload');
    const filePreview = document.getElementById('file-preview');
    const mediaCount = document.getElementById('media-count');

    if (mediaUpload) {
        mediaUpload.addEventListener('change', function() {
            // Reset preview
            filePreview.innerHTML = '';
            filePreview.classList.remove('hidden');
            
            if (this.files.length > 0) {
                // Show the count of files
                mediaCount.textContent = this.files.length;
                mediaCount.classList.remove('hidden');
                
                // Preview container
                const previewWrapper = document.createElement('div');
                previewWrapper.className = 'grid grid-cols-2 sm:grid-cols-3 gap-2';
                
                // Add a clear button
                const clearButton = document.createElement('button');
                clearButton.textContent = 'Clear Files';
                clearButton.className = 'text-xs text-red-600 hover:text-red-700 mb-2 underline';
                clearButton.onclick = function(e) {
                    e.preventDefault();
                    mediaUpload.value = '';
                    filePreview.classList.add('hidden');
                    mediaCount.classList.add('hidden');
                    filePreview.innerHTML = '';
                };
                filePreview.appendChild(clearButton);
                
                // Process each file
                Array.from(this.files).forEach(file => {
                    const fileType = file.type;
                    const fileSize = (file.size / (1024 * 1024)).toFixed(2); // size in MB
                    
                    const fileItem = document.createElement('div');
                    fileItem.className = 'p-2 border border-gray-200 rounded-md text-xs';
                    
                    // Different preview based on file type
                    if (fileType.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.className = 'h-20 w-full object-cover rounded-md mb-1';
                        img.file = file;
                        fileItem.appendChild(img);
                        
                        const reader = new FileReader();
                        reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
                        reader.readAsDataURL(file);
                    } else if (fileType.startsWith('video/')) {
                        fileItem.innerHTML = `<div class="flex items-center justify-center h-20 bg-gray-100 rounded-md mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>`;
                    } else if (fileType.startsWith('audio/')) {
                        fileItem.innerHTML = `<div class="flex items-center justify-center h-20 bg-gray-100 rounded-md mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>`;
                    } else {
                        // Documents and other files
                        fileItem.innerHTML = `<div class="flex items-center justify-center h-20 bg-gray-100 rounded-md mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>`;
                    }
                    
                    // File info
                    const fileInfo = document.createElement('div');
                    fileInfo.className = 'truncate';
                    fileInfo.innerHTML = `<span class="block truncate">${file.name}</span><span class="text-gray-500">${fileSize} MB</span>`;
                    fileItem.appendChild(fileInfo);
                    
                    previewWrapper.appendChild(fileItem);
                });
                
                filePreview.appendChild(previewWrapper);
            } else {
                filePreview.classList.add('hidden');
                mediaCount.classList.add('hidden');
            }
        });
    }

    // Toggle new post form
    document.getElementById('togglePostForm').addEventListener('click', function() {
        @guest
            // For non-authenticated users, redirect to login
            window.location.href = "{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}";
        @else
            // For authenticated users, show the form
            const form = document.getElementById('newPostContainer');
            form.classList.toggle('hidden');
            if (!form.classList.contains('hidden')) {
                form.scrollIntoView({ behavior: 'smooth' });
            }
        @endguest
    });

    // Handle empty state "Start a New Thread" button
    if (document.getElementById('startFirstPost')) {
        document.getElementById('startFirstPost').addEventListener('click', function() {
            @guest
                // For non-authenticated users, redirect to login
                window.location.href = "{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}";
            @else
                document.getElementById('togglePostForm').click();
            @endguest
        });
    }

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
        .then(response => {
            if (response.status === 401) {
                // User is not authenticated - ask to log in
                if (confirm('You need to be logged in to vote. Would you like to log in now?')) {
                    window.location.href = "{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}";
                }
                return { success: false };
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update the displayed vote count using the difference between upvotes and downvotes
                const upvoteCountElem = btn.parentElement.querySelector('.upvote-count');
                const downvoteCountElem = btn.parentElement.parentElement.querySelector('.downvote-count');
                upvoteCountElem.textContent = data.upvotes;
                downvoteCountElem.textContent = data.downvotes;
                
                // Provide visual feedback for the user's vote
                const upvoteBtn = btn.parentElement.querySelector('button[aria-label^="Upvote"]');
                const downvoteBtn = btn.parentElement.parentElement.querySelector('button[aria-label^="Downvote"]');
                
                // Reset both buttons to default style
                upvoteBtn.className = 'text-gray-600 hover:text-red-600';
                downvoteBtn.className = 'text-gray-600 hover:text-blue-600';
                
                // Highlight the selected vote button if it wasn't toggled off
                if (data.upvotes > 0 || data.downvotes > 0) {
                    if (voteValue === 1 && data.upvotes > data.downvotes) {
                        upvoteBtn.className = 'text-red-600 hover:text-red-700';
                    } else if (voteValue === -1 && data.downvotes > data.upvotes) {
                        downvoteBtn.className = 'text-blue-600 hover:text-blue-700';
                    }
                }
            } else if (data.message) {
                // Show error message if any
                console.error('Vote error:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Vote on a comment (AJAX call)
    function voteComment(commentId, voteValue, btn) {
        fetch(`/comments/${commentId}/vote`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ vote: voteValue })
        })
        .then(response => {
            if (response.status === 401) {
                // User is not authenticated - ask to log in
                if (confirm('You need to be logged in to vote. Would you like to log in now?')) {
                    window.location.href = "{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}";
                }
                return { success: false };
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update the displayed vote count using the difference between upvotes and downvotes
                const upvoteCountElem = btn.parentElement.querySelector('.upvote-count');
                const downvoteCountElem = btn.parentElement.parentElement.querySelector('.downvote-count');
                upvoteCountElem.textContent = data.upvotes;
                downvoteCountElem.textContent = data.downvotes;
                
                // Provide visual feedback for the user's vote
                const upvoteBtn = btn.parentElement.querySelector('button[aria-label^="Upvote"]');
                const downvoteBtn = btn.parentElement.parentElement.querySelector('button[aria-label^="Downvote"]');
                
                // Reset both buttons to default style
                upvoteBtn.className = 'text-gray-600 hover:text-red-600';
                downvoteBtn.className = 'text-gray-600 hover:text-blue-600';
                
                // Highlight the selected vote button if it wasn't toggled off
                if (data.upvotes > 0 || data.downvotes > 0) {
                    if (voteValue === 1 && data.upvotes > data.downvotes) {
                        upvoteBtn.className = 'text-red-600 hover:text-red-700';
                    } else if (voteValue === -1 && data.downvotes > data.upvotes) {
                        downvoteBtn.className = 'text-blue-600 hover:text-blue-700';
                    }
                }
            } else if (data.message) {
                // Show error message if any
                console.error('Vote error:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Toggle comments for a post
    function toggleComments(postId) {
        const commentsDiv = document.getElementById('comments-' + postId);
        commentsDiv.classList.toggle('hidden');
    }

    // Toggle reply form for a comment
    function toggleReplyForm(commentId) {
        const replyForm = document.getElementById('reply-form-' + commentId);
        replyForm.classList.toggle('hidden');
        
        // Focus the textarea if visible
        if (!replyForm.classList.contains('hidden')) {
            replyForm.querySelector('textarea').focus();
        }
    }

    // Function to report a post
    function reportPost(postId) {
        if (confirm('Are you sure you want to report this post?')) {
            fetch(`/posts/${postId}/report`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Post reported successfully.');
                } else {
                    alert('Error reporting post: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while reporting the post.');
            });
        }
    }

    // Confirmation dialog for deleting a post
    function confirmDeletePost(postId) {
        if (confirm('Are you sure you want to delete this post?')) {
            deletePost(postId);
        }
    }

    function deletePost(postId) {
        fetch(`/posts/${postId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('post-' + postId).remove();
            } else {
                alert('Unable to delete the post.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>

<!-- Google Maps API -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
@endsection
