@extends('layouts.user')

@section('page_title')
Search results for "{{$query}}"
@endsection
@section('page_content')

<!-- Include the same Livewire search bar at the top -->
@livewire('global-search')

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Search Results for "{{ $query }}"</h1>

    <!-- Offenders Section -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Matching Offenders ({{count($offenders)}})</h2>
        @if($offenders->count())
            <ul class="list-disc list-inside text-gray-700">
                @foreach($offenders as $off)
                @if ($off->report->verified)
                    <livewire:offender :offender="$off"></livewire:offender>                    
                @endif
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No offenders found.</p>
        @endif
    </div>

    <!-- Reports Section -->
    <div>
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Matching Reports ({{count($reports)}})</h2>
        @if($reports->count())
            <ul class="list-disc list-inside text-gray-700">
                @foreach($reports as $rep)
                    @if($rep->verified)    
                    <li>
                        Incident: {{ $rep->offender->offense_type }} - Location: {{ $rep->offender->location }}
                        <!-- Add more fields as needed -->
                    </li>
                    @endif
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No reports found.</p>
        @endif
    </div>
</div>
@endsection