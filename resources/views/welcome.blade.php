<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>সচেতন | Bangladesh's First Sex Offender Registry</title>
    <link rel="icon" type="image/png" href="{{asset('iconmark.png')}}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    @auth
        <livewire:public-navigation></livewire:public-navigation>
    @endauth
    <div class="w-full bg-white">

        <!-- Header Section -->
        <header class=" py-6">
            <div class="container flex items-center justify-center flex-col mx-auto px-4 text-center">
                <a href="{{route('home')}}">
                    <img src="{{asset('wide_logo.png')}}" class="h-[10vh]" alt="Shocheton.org">
                </a>
                <h1 class="text-xl mt-6 md:text-2xl font-bold uppercase tracking-wider">
                    Bangladesh Sex Offenders<br>Public Registry
                </h1>
            </div>
        </header>
    
        <link rel="icon" type="image/png" href="{{asset('iconmark.png')}}">
    
        <!-- Main Container -->
        <main class="container flex flex-col w-ful justify-center items-center mx-auto px-4 py-6">
    
            <!-- Report Button -->
            <div class="text-center mb-6">
                <a href="{{ route('submit.report.form') }}"
                   class="inline-block bg-red-600 hover:bg-red-700 text-center text-white font-semibold uppercase px-6 py-3 rounded shadow">
                    I WANT TO REPORT AN INCIDENT
                </a>
            </div>
            
            <!-- Community Forums Button -->
            <div class="text-center mb-6">
                <a href="{{ route('forums.index') }}"
                   class="inline-block bg-red-600 hover:bg-red-700 text-center text-white font-semibold uppercase px-6 py-3 rounded shadow">
                    আলোচনাস্হ | COMMUNITY FORUM
                </a>
            </div>
            
            @guest
                <!-- Map Button -->
                <div class="text-center mb-6">
                    <a 
                        href="{{ route('map') }}"
                        class="inline-block bg-red-600 hover:bg-red-700 text-center text-white font-semibold uppercase px-6 py-3 rounded shadow"
                    >
                        সচেতন MAP
                    </a>
                </div>
            @endguest
            @auth
                <!-- Map Button -->
                <div class="text-center mb-6">
                    <a 
                        href="{{ route('map') }}"
                        class="inline-block bg-red-600 hover:bg-red-700 text-center text-white font-semibold uppercase px-6 py-3 rounded shadow"
                    >
                        SEND EMERGENCY GPS ALERT
                    </a>
                </div>
            @endauth
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-4 my-6">
                @guest
                <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0">
                    <a 
                        href="{{ route('register') }}" 
                        class="w-full md:w-auto bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded font-semibold text-center"
                    >
                        সাইন আপ | Sign Up
                    </a>
                    <a 
                        href="{{ route('login') }}" 
                        class="w-full md:w-auto bg-black hover:bg-gray-900 text-white px-4 py-2 rounded font-semibold text-center"
                    >
                        প্রবেশ | Login
                    </a>
                </div>
                @endguest


            </div>
            <!-- "How it Works" link -->
            <a 
                href="{{ route('explain') }}"
                class="font-bold underline text-gray-800"
            >
                কিভাবে এটি কাজ করে | How it Works
            </a>
            
    
            <livewire:global-search></livewire:global-search>
            <!-- Toggle Button for Disclaimer -->
            <div 
            id="disclaimerToggle" 
            class="flex items-center space-x-2 cursor-pointer text-sm font-semibold text-gray-700 mb-2"
            >
            <!-- Arrow Icon (rotates on click) -->
            <svg 
            id="disclaimerArrow"
            class="h-4 w-4 text-gray-600 transition-transform duration-200"
            fill="none" 
            stroke="currentColor" 
            stroke-width="2" 
            viewBox="0 0 24 24"
            >
            <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
            <span>DISCLAIMER & NOTE</span>
            </div>

            <!-- Disclaimer Container (hidden by default) -->
            <div 
            id="disclaimerContainer" 
            class="hidden bg-gray-50 border border-gray-200 p-4 rounded text-left"
            >
            <!-- Language Tabs -->
            <div class="flex items-center space-x-2 mb-4">
            <button 
                id="btnBangla" 
                class="px-3 py-1 rounded text-sm font-semibold bg-red-600 text-white focus:outline-none"
            >
                বাংলা
            </button>
            <button 
                id="btnEnglish" 
                class="px-3 py-1 rounded text-sm font-semibold bg-gray-600 text-white focus:outline-none"
            >
                English
            </button>
            </div>

            <!-- Bangla Disclaimer (default visible) -->
            <div id="disclaimerBangla" class="block text-sm text-gray-700 space-y-2">
            <ul class="list-disc pl-5">
                <li>এটি কোনো সরকারি ওয়েবসাইট নয়</li>
                <li>রিপোর্টার/ভিক্টিমের তথ্য ডিফল্টভাবে সুরক্ষিত থাকে এবং কখনই সর্বসাধারণের জন্য প্রদর্শিত হয় না</li>
                <li>যদি আপনার জমা দেওয়া রিপোর্ট সার্চে না দেখা যায়, তাহলে তা এখনো মডারেশন টিমের পর্যালোচনায় রয়েছে</li>
                <li>এই ওয়েবসাইটটি বেটা পর্যায়ে রয়েছে এবং আপনি কারিগরি সমস্যার সম্মুখীন হতে পারেন।
                <br>কোনো বাগ পেলে আমাদের সোশ্যাল মিডিয়ায় জানাবেন:
                <div class="flex space-x-6 mt-1">
                    <a target="_blank" href="https://www.instagram.com/shocheton.live/" class="text-red-500">Instagram</a>
                    <a target="_blank" href="https://www.facebook.com/profile.php?id=61573974269133" class="text-red-500">Facebook</a>
                </div>
                </li>
            </ul>
            </div>

            <!-- English Disclaimer (hidden by default) -->
            <div id="disclaimerEnglish" class="hidden text-sm text-gray-700 space-y-2">
            <ul class="list-disc pl-5">
                <li>THIS IS NOT A GOVERNMENT WEBSITE</li>
                <li>INFORMATION ABOUT REPORTER/VICTIM IS PROTECTED BY DEFAULT AND IS NEVER DISPLAYED PUBLICLY</li>
                <li>IF YOUR SUBMITTED REPORT IS NOT VISIBLE IN SEARCH, IT IS STILL UNDER REVIEW BY OUR MODERATION TEAM</li>
                <li>THIS WEBSITE IS IN BETA AND YOU MAY EXPERIENCE TECHNICAL DIFFICULTIES.
                <br>PLEASE REPORT ANY BUGS TO OUR SOCIALS:
                <div class="flex space-x-6 mt-1">
                    <a target="_blank" href="https://www.instagram.com/shocheton.live/" class="text-red-500">Instagram</a>
                    <a target="_blank" href="https://www.facebook.com/profile.php?id=61573974269133" class="text-red-500">Facebook</a>
                </div>
                </li>
            </ul>
            </div>
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
                disclaimerArrow.classList.add('rotate-90'); // rotate arrow
            } else {
                disclaimerContainer.classList.add('hidden');
                disclaimerArrow.classList.remove('rotate-90');
            }
            });

            // Switch to Bangla
            btnBangla.addEventListener('click', function() {
            currentLang = 'bangla';
            disclaimerBangla.classList.remove('hidden');
            disclaimerBangla.classList.add('block');
            disclaimerEnglish.classList.add('hidden');
            // Update button colors
            btnBangla.classList.remove('bg-gray-600');
            btnBangla.classList.add('bg-red-600');
            btnEnglish.classList.remove('bg-red-600');
            btnEnglish.classList.add('bg-gray-600');
            });

            // Switch to English
            btnEnglish.addEventListener('click', function() {
            currentLang = 'english';
            disclaimerEnglish.classList.remove('hidden');
            disclaimerEnglish.classList.add('block');
            disclaimerBangla.classList.add('hidden');
            // Update button colors
            btnEnglish.classList.remove('bg-gray-600');
            btnEnglish.classList.add('bg-red-600');
            btnBangla.classList.remove('bg-red-600');
            btnBangla.classList.add('bg-gray-600');
            });
            </script>

            <!-- Offenders Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($offenders as $offender)
                    <livewire:offender :offender="$offender"></livewire:offender>
                @endforeach
    
            </div> <!-- End Offenders Grid -->
    
        </main>
    </div>
</body>
</html>