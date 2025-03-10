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
    
            <span class="flex w-full justify-center items-center font-bold underline my-6">
                <a href="{{route('explain')}}">কিভাবে এটি কাজ করে | How it Works</a>
                @guest
                <a href="{{route('login')}}" class="bg-black p-3 border-box rounded-md text-white font-bold ml-3">প্রবেশ | Login</a>                    
                @endguest
            </span>
    
            <livewire:global-search></livewire:global-search>
            <small class="font-bold TEXT-CENTER text-gray-400 mt-6">NOTE : *IF YOUR SUBMITTED REPORT IS NOT VISIBLE IN SEARCH,<br>
                IT IS STILL IN REVIEW BY MODERATION TEAM.*</small>
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