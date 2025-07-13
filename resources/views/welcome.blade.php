<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>সচেতন | Empowering Citizens Against Abuse and Extortion</title>
    <link rel="icon" type="image/png" href="{{asset('iconmark.png')}}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50">
    @auth
        <livewire:public-navigation></livewire:public-navigation>
    @endauth
    
    <div class="w-full bg-white shadow-sm">
        <!-- Header Section -->
        <header class="py-4 border-b border-gray-100">
            <div class="container flex items-center justify-center flex-col mx-auto px-4 text-center">
                <a href="{{route('home')}}">
                    <img src="{{asset('wide_logo.png')}}" class="h-[8vh]" alt="Shocheton.org">
                </a>
                <h1 class="text-lg mt-3 md:text-xl font-bold uppercase tracking-wider text-gray-800">
                    Empowering Citizens Against Abuse<br>and Extortion
                </h1>
            </div>
        </header>
    
        <!-- Main Container -->
        <main class="container mx-auto px-4 py-6">
            <!-- Flash Messages -->
            @if(session('success'))
            <div class="max-w-4xl mx-auto mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success! </strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <button onclick="this.parentElement.style.display='none'" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </button>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="max-w-4xl mx-auto mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error! </strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <button onclick="this.parentElement.style.display='none'" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </button>
                </div>
            </div>
            @endif

            @if(session('type') == 'extortion' && session('report_id'))
            <div class="max-w-4xl mx-auto mb-4">
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Extortion Report Submitted! </strong>
                    <span class="block sm:inline">Your report has been submitted successfully. We will review it shortly.</span>
                    <p class="mt-2">Report ID: #{{ session('report_id') }}</p>
                    <button onclick="this.parentElement.style.display='none'" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-blue-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </button>
                </div>
            </div>
            @endif

            <!-- Priority Section: Search & Report -->
            <div class="max-w-4xl mx-auto mb-8">
                <!-- Report Button - Prominent -->
                <div class="text-center mb-6">
                    <a href="{{ route('submit.report.form') }}"
                       class="inline-block bg-red-600 hover:bg-red-700 text-center text-white font-semibold uppercase px-6 py-4 rounded-lg shadow-md w-full sm:w-auto transition duration-200">
                        <span class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            I WANT TO REPORT AN INCIDENT
                        </span>
                    </a>
                </div>

                <!-- Report Extortion Button -->
                <div class="text-center mb-6">
                    <a href="{{ route('extortion.report.form') }}"
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-center text-white font-semibold uppercase px-6 py-4 rounded-lg shadow-md w-full sm:w-auto transition duration-200">
                        <span class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            REPORT CHADABAAJ (POLITICAL EXTORTION)
                        </span>
                    </a>
                </div>
                
                <!-- Global Search -->
                <div class="mb-8">
                    <livewire:global-search></livewire:global-search>
                </div>
            </div>
            
            <!-- Navigation Options in Card-Based Grid -->
            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <!-- Community Forums Card -->
                    <a href="{{ route('forums.index') }}" 
                       class="bg-white hover:bg-gray-50 rounded-lg shadow-sm p-4 border border-gray-100 flex flex-col items-center justify-center transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                        <span class="text-center font-semibold text-sm uppercase">আলোচনাস্হ<br>Community Forum</span>
                    </a>
                    
                    <!-- Heatmap Card -->
                    <a href="{{ route('heatmap') }}" 
                       class="bg-white hover:bg-gray-50 rounded-lg shadow-sm p-4 border border-gray-100 flex flex-col items-center justify-center transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        <span class="text-center font-semibold text-sm uppercase">Offense<br>Heatmap</span>
                    </a>
                    
                    <!-- Map Button Card -->
                    <a href="{{ route('map') }}" 
                       class="bg-white hover:bg-gray-50 rounded-lg shadow-sm p-4 border border-gray-100 flex flex-col items-center justify-center transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-center font-semibold text-sm uppercase">
                            @auth
                                Emergency<br>GPS Alert
                            @else
                                সচেতন<br>MAP
                            @endauth
                        </span>
                    </a>
                    
                    <!-- How it Works Card -->
                    <a href="{{ route('explain') }}" 
                       class="bg-white hover:bg-gray-50 rounded-lg shadow-sm p-4 border border-gray-100 flex flex-col items-center justify-center transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-center font-semibold text-sm uppercase">কিভাবে এটি কাজ করে<br>How it Works</span>
                    </a>
                </div>
                
                <!-- Authentication Section -->
                @guest
                <div class="flex justify-center mb-8">
                    <div class="flex space-x-4">
                        <a href="{{ route('register') }}" 
                           class="bg-white hover:bg-red-50 border border-red-200 text-red-600 px-5 py-2 rounded-md font-semibold text-center transition duration-200 text-sm">
                            সাইন আপ | Sign Up
                        </a>
                        <a href="{{ route('login') }}" 
                           class="bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 px-5 py-2 rounded-md font-semibold text-center transition duration-200 text-sm">
                            প্রবেশ | Login
                        </a>
                    </div>
                </div>
                @endguest
                
                <!-- Disclaimer Section (Minimized) -->
                <div class="max-w-4xl mx-auto mb-10">
                    <div id="disclaimerToggle" 
                         class="flex items-center justify-center space-x-2 cursor-pointer text-sm font-medium text-gray-600 mb-2 py-2 border-b border-gray-100">
                        <svg id="disclaimerArrow"
                             class="h-4 w-4 text-gray-400 transition-transform duration-200"
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>
                        <span>DISCLAIMER & NOTE</span>
                    </div>
                
                    <!-- Disclaimer Container (hidden by default) -->
                    <div id="disclaimerContainer" 
                         class="hidden bg-white border border-gray-100 p-4 rounded-lg shadow-sm text-left">
                        <!-- Language Tabs -->
                        <div class="flex items-center space-x-2 mb-4">
                            <button id="btnBangla" 
                                class="px-3 py-1 rounded text-sm font-semibold bg-red-600 text-white focus:outline-none">
                                বাংলা
                            </button>
                            <button id="btnEnglish" 
                                class="px-3 py-1 rounded text-sm font-semibold bg-gray-200 text-gray-700 focus:outline-none">
                                English
                            </button>
                        </div>
                
                        <!-- Bangla Disclaimer (default visible) -->
                        <div id="disclaimerBangla" class="block text-sm text-gray-600 space-y-2">
                            <ul class="list-disc pl-5">
                                <li>এটি কোনো সরকারি ওয়েবসাইট নয়</li>
                                <li>রিপোর্টার/ভিক্টিমের তথ্য ডিফল্টভাবে সুরক্ষিত থাকে এবং কখনই সর্বসাধারণের জন্য প্রদর্শিত হয় না</li>
                                <li>যদি আপনার জমা দেওয়া রিপোর্ট সার্চে না দেখা যায়, তাহলে তা এখনো মডারেশন টিমের পর্যালোচনায় রয়েছে</li>
                                <li>এই ওয়েবসাইটটি বেটা পর্যায়ে রয়েছে এবং আপনি কারিগরি সমস্যার সম্মুখীন হতে পারেন।
                                <br>কোনো বাগ পেলে আমাদের সোশ্যাল মিডিয়ায় জানাবেন:
                                <div class="flex space-x-6 mt-1">
                                    <a target="_blank" href="https://www.instagram.com/shocheton.live/" class="text-red-500 hover:underline">Instagram</a>
                                    <a target="_blank" href="https://www.facebook.com/profile.php?id=61573974269133" class="text-red-500 hover:underline">Facebook</a>
                                </div>
                                </li>
                            </ul>
                        </div>
                
                        <!-- English Disclaimer (hidden by default) -->
                        <div id="disclaimerEnglish" class="hidden text-sm text-gray-600 space-y-2">
                            <ul class="list-disc pl-5">
                                <li>THIS IS NOT A GOVERNMENT WEBSITE</li>
                                <li>INFORMATION ABOUT REPORTER/VICTIM IS PROTECTED BY DEFAULT AND IS NEVER DISPLAYED PUBLICLY</li>
                                <li>IF YOUR SUBMITTED REPORT IS NOT VISIBLE IN SEARCH, IT IS STILL UNDER REVIEW BY OUR MODERATION TEAM</li>
                                <li>THIS WEBSITE IS IN BETA AND YOU MAY EXPERIENCE TECHNICAL DIFFICULTIES.
                                <br>PLEASE REPORT ANY BUGS TO OUR SOCIALS:
                                <div class="flex space-x-6 mt-1">
                                    <a target="_blank" href="https://www.instagram.com/shocheton.live/" class="text-red-500 hover:underline">Instagram</a>
                                    <a target="_blank" href="https://www.facebook.com/profile.php?id=61573974269133" class="text-red-500 hover:underline">Facebook</a>
                                </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Extortionists Grid -->
            @if($extortionists->isNotEmpty())
            <div class="max-w-6xl mx-auto">
                <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">Recent Extortionists</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($extortionists as $extortionist)
                        <div class="bg-white shadow-sm p-4 rounded-lg">
                            <h3 class="text-lg font-bold text-gray-800">
                                {{ $extortionist->name ?: $extortionist->political_affiliation }}
                            </h3>
                            <p class="text-sm text-gray-600">
                                {{ $extortionist->business_name }}
                            </p>
                            <p class="mt-2 text-xs text-gray-500">
                                Reported on {{ $extortionist->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </main>
    </div>

    <script>
        // Grab elements
        const disclaimerToggle = document.getElementById('disclaimerToggle');
        const disclaimerContainer = document.getElementById('disclaimerContainer');
        const disclaimerArrow = document.getElementById('disclaimerArrow');
        const btnBangla = document.getElementById('btnBangla');
        const btnEnglish = document.getElementById('btnEnglish');
        const disclaimerBangla = document.getElementById('disclaimerBangla');
        const disclaimerEnglish = document.getElementById('disclaimerEnglish');

        let disclaimersOpen = false; // hidden by default
        let currentLang = 'bangla'; // default language

        // Toggle the entire disclaimer container
        disclaimerToggle.addEventListener('click', function() {
            disclaimersOpen = !disclaimersOpen;
            if (disclaimersOpen) {
                disclaimerContainer.classList.remove('hidden');
                disclaimerArrow.classList.add('rotate-180'); // rotate arrow down
            } else {
                disclaimerContainer.classList.add('hidden');
                disclaimerArrow.classList.remove('rotate-180');
            }
        });

        // Switch to Bangla
        btnBangla.addEventListener('click', function() {
            currentLang = 'bangla';
            disclaimerBangla.classList.remove('hidden');
            disclaimerBangla.classList.add('block');
            disclaimerEnglish.classList.add('hidden');
            // Update button colors
            btnBangla.classList.remove('bg-gray-200', 'text-gray-700');
            btnBangla.classList.add('bg-red-600', 'text-white');
            btnEnglish.classList.remove('bg-red-600', 'text-white');
            btnEnglish.classList.add('bg-gray-200', 'text-gray-700');
        });

        // Switch to English
        btnEnglish.addEventListener('click', function() {
            currentLang = 'english';
            disclaimerEnglish.classList.remove('hidden');
            disclaimerEnglish.classList.add('block');
            disclaimerBangla.classList.add('hidden');
            // Update button colors
            btnEnglish.classList.remove('bg-gray-200', 'text-gray-700');
            btnEnglish.classList.add('bg-red-600', 'text-white');
            btnBangla.classList.remove('bg-red-600', 'text-white');
            btnBangla.classList.add('bg-gray-200', 'text-gray-700');
        });
    </script>
    @livewireScripts
</body>
</html>