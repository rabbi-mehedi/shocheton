@extends('layouts.user')
@section('page_title','Bangladesh Sex Offender Registry')
@section('page_content')
<div class="w-full bg-white">

    <!-- Header Section -->
    <header class="bg-red-600 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-xl md:text-2xl font-bold uppercase tracking-wider">
                Bangladesh Sex Offenders Public Registry
            </h1>
        </div>
    </header>

    <link rel="icon" type="image/png" href="{{asset('iconmark.png')}}">

    <!-- Main Container -->
    <main class="container mx-auto px-4 py-6">

        <!-- Report Button -->
        <div class="text-center mb-6">
            <a href="{{ route('submit.report.form') }}"
               class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold uppercase px-6 py-3 rounded shadow">
                I WANT TO REPORT AN INCIDENT
            </a>
        </div>

        <!-- Search Bar -->
        <div class="flex items-center justify-center w-full max-w-lg mx-auto mb-8">
            <div class="relative w-full">
                <div class="shadow-md rounded-full overflow-hidden">
                    <input
                        type="text"
                        placeholder="Search by Name, Location, Details..."
                        class="w-full py-3 px-5 pr-16 text-gray-700 bg-white border-none focus:outline-none focus:ring-2 focus:ring-red-400 rounded-full"
                    >
                    <button
                        class="absolute inset-y-0 right-0 flex items-center justify-center bg-red-600 text-white px-4 m-1 rounded-full hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400"
                    >
                        Search
                    </button>
                </div>
            </div>
        </div>
  
        <!-- Offenders Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($offenders as $offender)
                <!-- Card Container -->
                <div class="bg-white shadow-md p-4 rounded-lg flex flex-col sm:flex-row items-center sm:items-start space-y-4 sm:space-y-0 sm:space-x-4">
                    
                    <!-- Offender Image -->
                    <div class="w-16 h-16 flex-shrink-0 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center">
                        @if (method_exists($offender, 'hasMedia') && $offender->hasMedia('offender_photo'))
                            <!-- Show the real offender image -->
                            <img 
                                src="{{ $offender->getFirstMediaUrl('offender_photo') }}" 
                                alt="Offender Photo" 
                                class="w-16 h-16 object-cover"
                            >
                        @else
                            <!-- Placeholder SVG if no image -->
                            <svg class="w-8 h-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" 
                                 viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 4.5c4.9 0 9 4 9 9s-4 9-9 9-9-4-9-9 
                                         4-9 9-9zm0-2.4c-6.4 0-11.4 5-11.4 
                                         11.4s5 11.4 11.4 11.4 11.4-5 
                                         11.4-11.4-5-11.4-11.4-11.4zm0 
                                         6.6c1.8 0 3.3 1.5 3.3 3.3s-1.5 
                                         3.3-3.3 3.3-3.3-1.5-3.3-3.3 
                                         1.5-3.3 3.3-3.3z"/>
                            </svg>
                        @endif
                    </div>

                    <!-- Offender Details -->
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold text-gray-900">
                            {{ $offender->name ?? 'Unknown Offender' }}
                        </h2>
                        <p class="text-sm text-gray-600">
                            Age: <span class="font-medium">{{ $offender->age ?? 'N/A' }}</span>
                        </p>
                        
                        <div class="flex flex-wrap gap-2 mt-2">
                            <span class="text-xs px-3 py-1 bg-gray-100 rounded-full text-gray-800">
                                <strong>Nature of Incident:</strong> 
                                {{ $offender->offense_type ?? 'Not Specified' }}
                            </span>
                            <span class="text-xs px-3 py-1 bg-gray-100 rounded-full text-gray-800">
                                <strong>Location:</strong> 
                                {{ $offender->location ?? 'Unknown' }}
                            </span>
                        </div>

                        <!-- View Evidence Button (Only if there's evidence) -->
                        @if(!empty($offender->evidence))
                            <div class="mt-3">
                                <a href="{{ route('offenders.evidence', $offender->id) }}" 
                                   class="inline-flex items-center space-x-1 text-red-600 font-bold hover:underline">
                                    <span>VIEW EVIDENCE</span>
                                    <svg class="w-5 h-5 text-red-600" xmlns="http://www.w3.org/2000/svg" 
                                         viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 4.5c4.9 0 9 4 9 9s-4 9-9 
                                                 9-9-4-9-9 4-9 9-9zm0-2.4c-6.4 
                                                 0-11.4 5-11.4 11.4s5 11.4 
                                                 11.4 11.4 11.4-5 11.4-11.4
                                                 -5-11.4-11.4-11.4zm0 
                                                 6.6c1.8 0 3.3 1.5 3.3 
                                                 3.3s-1.5 3.3-3.3 
                                                 3.3-3.3-1.5-3.3-3.3 
                                                 1.5-3.3 3.3-3.3z"/>
                                    </svg>
                                </a>
                            </div>
                        @endif

                        <!-- Verification Status -->
                        <div class="mt-2">
                            @if($offender->verification_status === 'pending')
                                <span class="text-xs px-3 py-1 rounded-lg bg-yellow-400 text-white font-bold">
                                    PENDING VERIFICATION
                                </span>
                            @elseif($offender->verification_status === 'verified')
                                <span class="text-xs px-3 py-1 rounded-lg bg-green-600 text-white font-bold">
                                    VERIFIED
                                </span>
                            @elseif($offender->verification_status === 'rejected')
                                <span class="text-xs px-3 py-1 rounded-lg bg-red-600 text-white font-bold">
                                    REJECTED
                                </span>
                            @else
                                <span class="text-xs px-3 py-1 rounded-lg bg-gray-400 text-white font-bold">
                                    UNKNOWN STATUS
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Timestamp (e.g., '3 weeks ago') -->
                    <div class="text-xs text-gray-500 sm:self-end">
                        {{ $offender->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach

        </div> <!-- End Offenders Grid -->

    </main>
</div>
@endsection
