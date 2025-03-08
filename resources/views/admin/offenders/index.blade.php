@extends('layouts.admin')
@section('page_title','Offenders | Admin Panel')
@section('page_content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-4">All Offenders ({{count($allOffenders)}})</h1>

    <!-- If you want pagination, ensure your controller uses paginate() 
         and that you have $allOffenders->links() at the bottom -->

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Age</th>
                    <th class="px-4 py-2 text-left">Gender</th>
                    <th class="px-4 py-2 text-left">Offense Type</th>
                    <th class="px-4 py-2 text-left">Location</th>
                    <th class="px-4 py-2 text-left">Created</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($allOffenders as $offender)
                
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $offender->id }}</td>
                    <td class="px-4 py-2">{{ $offender->name }}</td>
                    <td class="px-4 py-2">{{ $offender->age ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $offender->gender ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $offender->offense_type ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $offender->location ?? 'Unknown' }}</td>
                    <td class="px-4 py-2">
                        <!-- Format created date as needed -->
                        {{ $offender->created_at->format('Y-m-d') }}
                    </td>
                    <td class="px-4 py-2">
                        <!-- Example action link -->
                        <a href="#"
                           class="text-blue-600 hover:underline">
                           Edit
                        </a>
                        <!-- Add more actions as needed (delete, view details, etc.) -->
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-2 text-center text-gray-500">
                        No offenders found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- If using pagination:
    <div class="mt-4">
        {{-- {{ $allOffenders->links() }} --}}
    </div>
    -->
</div>
@endsection
