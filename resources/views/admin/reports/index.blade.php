@extends('layouts.admin')
@section('page_title','Reports | Admin Panel')
@section('page_content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-4">All Reports ({{count($allReports)}})</h1>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-4">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">
                {{ session('success') }}
            </span>
        </div>
    @endif
    <!-- If you want pagination, ensure your controller uses paginate() 
         and that you have $allReports->links() at the bottom -->

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Incident Type</th>
                    <th class="px-4 py-2 text-left">Location</th>
                    <th class="px-4 py-2 text-left">Reporter</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Created</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($allReports as $report)
                
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $report->id }}</td>
                    <td class="px-4 py-2">{{ $report->offender->offense_type ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $report->offender->location ?? 'Unknown' }}</td>
                    <!-- If you have a relationship to a User model, e.g. $report->user->name -->
                    <td class="px-4 py-2">
                        {{ optional($report->user)->name ?? 'Anonymous' }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $report->verified ?? 'Pending' }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $report->created_at->format('Y-m-d') }}
                    </td>
                    <td class="px-4 py-2">
                        <!-- Example "View" link or "Edit" button -->
                        <a href="{{route('admin.report.edit', $report->id)}}" 
                           class="text-blue-600 hover:underline">
                           Edit
                        </a>

                        <a href="{{route('admin.report.view', $report->id)}}" 
                            class="text-blue-600 hover:underline">
                            View
                         </a>
                        <!-- Add more actions as needed (delete, edit, etc.) -->
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-2 text-center text-gray-500">
                        No reports found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- If using pagination:
    <div class="mt-4">
        {{-- {{ $allReports->links() }} --}}
    </div>
    -->
</div>
@endsection
