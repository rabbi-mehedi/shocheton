@extends('layouts.user') 
@section('page_title', 'Thank You for Reporting') 
@section('page_content')

<div class="min-h-screen flex flex-col items-center justify-center bg-white px-6 py-8 text-center">

    <!-- Main Heading -->
    <h1 class="text-2xl font-bold text-gray-900">Thank you for reporting</h1>

    <!-- Subheading / Message -->
    <p class="mt-3 text-gray-700">
        We are incredibly sorry to hear about this experience.<br>
        Your account has been documented, and will be reviewed shortly by our moderation team.
    </p>

    <!-- Support Links Heading -->
    <h2 class="mt-6 font-semibold text-gray-900 uppercase tracking-wide">
        Support links you may find helpful
    </h2>

    <!-- Support Links (Buttons) -->
    <div class="flex flex-wrap items-center justify-center mt-4 space-x-2">
        <a href="#"
           class="border border-gray-800 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
           Support Groups
        </a>
        <a href="#"
           class="border border-gray-800 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
           Financial Aid
        </a>
        <a href="#"
           class="border border-gray-800 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
           Legal
        </a>
        <a href="#"
           class="border border-gray-800 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
           Medical
        </a>
        <a href="#"
           class="border border-gray-800 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
           Therapy
        </a>
    </div>

    <!-- Go Back Button -->
    <div class="mt-8">
        <a href="{{route('home')}}"
                class="border border-gray-800 text-gray-800 px-6 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
            Go Back
        </a>
    </div>
</div>

@endsection
