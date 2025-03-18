@extends('layouts.user')
@section('page_title','সম্পদ | Resources')
@section('page_content')

<div class="w-full flex justify-center flex-col items-center">
    <!-- Logo -->
    <a href="{{ route('home') }}">
        <img src="{{ asset('wide_logo.png') }}" alt="shocheton.org" class="my-6 h-[10vh]">
    </a>

    <!-- Header -->
    <header class="bg-red-600 text-white py-4 mb-2">
        <div class="container mx-auto px-4 max-w-5xl flex flex-col md:flex-row items-center justify-center">
            <h1 class="text-2xl md:text-3xl font-bold uppercase tracking-wide md:tracking-wider leading-tight text-center md:text-left">
                Resources
            </h1>
        </div>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Legal Aid Card -->
        <a href="#" class="group block rounded-lg border-2 border-red-600 text-red-600 p-6 transition-all duration-300">
            <div class="flex items-center mb-2 space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
                <h2 class="text-xl font-semibold group-hover:text-white">Legal Aid</h2>
            </div>
            <p class="group-hover:text-white">Find legal support services, free consultations, and guidance for victims seeking justice.</p>
        </a>

        <!-- Medical Aid Card -->
        <a href="#" class="group block rounded-lg border-2 border-red-600 text-red-600 p-6 transition-all duration-300">
            <div class="flex items-center mb-2 space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
                <h2 class="text-xl font-semibold group-hover:text-white">Medical Aid</h2>
            </div>
            <p class="group-hover:text-white">Access hospitals, clinics, and medical professionals offering specialized care.</p>
        </a>

        <!-- Psychological Aid Card -->
        <a href="#" class="group block rounded-lg border-2 border-red-600 text-red-600 p-6 transition-all duration-300">
            <div class="flex items-center mb-2 space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call">
                    <path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                <h2 class="text-xl font-semibold group-hover:text-white">Psychological Aid</h2>
            </div>
            <p class="group-hover:text-white">Find therapists, counselors, and support groups to assist emotional recovery.</p>
        </a>

        <!-- NGO Support Card -->
        <a href="#" class="group block rounded-lg border-2 border-red-600 text-red-600 p-6 transition-all duration-300">
            <div class="flex items-center mb-2 space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <h2 class="text-xl font-semibold group-hover:text-white">NGO Support</h2>
            </div>
            <p class="group-hover:text-white">Connect with NGOs that provide advocacy, protection, and additional services.</p>
        </a>
    </div>
</div>

@endsection
