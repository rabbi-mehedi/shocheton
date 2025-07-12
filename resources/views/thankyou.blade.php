@extends('layouts.user') 
@section('page_title', 'Thank You for Reporting') 
@section('page_content')

<div class="min-h-screen flex flex-col items-center justify-center bg-white px-6 py-8 text-center">

    <!-- Main Heading -->
    <h1 class="text-2xl font-bold text-gray-900">Thank you for reporting</h1>

    <!-- Subheading / Message -->
    @if(isset($type) && $type == 'extortion')
        <p class="mt-3 text-gray-700">
            We appreciate your courage in reporting political extortion.<br>
            Your report has been documented and will be reviewed shortly by our moderation team.
        </p>
    @else
        <p class="mt-3 text-gray-700">
            We are incredibly sorry to hear about this experience.<br>
            Your account has been documented, and will be reviewed shortly by our moderation team.
        </p>
    @endif

    <!-- Support Links Heading -->
    <h2 class="mt-6 font-semibold text-gray-900 uppercase tracking-wide">
        Support links you may find helpful
    </h2>

    <!-- Support Links (Buttons) -->
    @if(isset($type) && $type == 'extortion')
        <div class="flex flex-wrap items-center justify-center mt-4 gap-2">
            <a href="#"
               class="border border-gray-800 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
               Business Support
            </a>
            <a href="#"
               class="border border-gray-800 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
               Legal Aid
            </a>
            <a href="#"
               class="border border-gray-800 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
               NGO Resources
            </a>
            <a href="#"
               class="border border-gray-800 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
               Security Advice
            </a>
        </div>
    @else
        <div class="flex flex-wrap items-center justify-center mt-4 gap-2">
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
    @endif

    <!-- Next Steps Information -->
    <div class="mt-8 max-w-lg mx-auto bg-blue-50 p-4 rounded-lg">
        <h3 class="font-semibold text-blue-800">What happens next?</h3>
        @if(isset($type) && $type == 'extortion')
            <p class="mt-2 text-sm text-blue-700">
                Our team will review your report within 24-48 hours. If you've allowed us to contact you, 
                we may reach out for more information. All reports are handled with strict confidentiality.
            </p>
        @else
            <p class="mt-2 text-sm text-blue-700">
                Our moderation team will review your report within 24-48 hours. If you've requested support, 
                relevant organizations will be notified. All personal details remain protected according to 
                your privacy preferences.
            </p>
        @endif
    </div>

    <!-- Go Back Button -->
    <div class="mt-8">
        <a href="{{route('home')}}"
                class="border border-gray-800 text-gray-800 px-6 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
            Return to Home
        </a>
    </div>
</div>

@endsection
