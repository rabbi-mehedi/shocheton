@extends('layouts.admin')
@section('page_title','Dashboard')
@section('page_content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Admin Dashboard</h1>

    <!-- Overview Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Users -->
        <div class="bg-white shadow rounded-lg p-4 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Total Users</h2>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{count($allUsers)}}</p>
            </div>
            <div class="text-gray-400">
                <!-- Icon (example user icon) -->
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5.121 17.804A8 8 0 1116 17.75M12 14c-2.828 0-5-2.239-5-5s2.172-5 5-5 5 2.239 5 5-2.172 5-5 5z"/>
                </svg>
            </div>
        </div>

        <!-- Total Offenders -->
        <div class="bg-white shadow rounded-lg p-4 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Total Offenders</h2>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{count($allOffenders)}}</p>
            </div>
            <div class="text-gray-400">
                <!-- Icon (example caution icon) -->
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3l-8.47-14.14a2 2 0 00-3.42 0zM12 9v4m0 4h.01"/>
                </svg>
            </div>
        </div>

        <!-- Total Reports -->
        <div class="bg-white shadow rounded-lg p-4 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Total Reports</h2>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{count($allReports)}}</p>
            </div>
            <div class="text-gray-400">
                <!-- Icon (example document icon) -->
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M7 8h10M7 12h8m-5 4h5M14 2H6a2 2 0 00-2 2v16
                             a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/>
                </svg>
            </div>
        </div>

        <!-- Pending Reps -->
        @if($pendingReps > 0)
        <div class="bg-yellow-100 shadow rounded-lg p-4 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-yellow-800">Pending Applications</h2>
                <p class="text-3xl font-bold text-yellow-900 mt-2">{{$pendingReps}}</p>
            </div>
            <div class="text-yellow-500">
                <svg class="w-12 h-12"  fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        @endif
    </div>

    <!-- Links to Index Pages -->
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-4 gap-4">
        <a href="{{ route('admin.users') }}"
           class="bg-red-600 text-white text-center py-3 rounded shadow hover:bg-red-700 transition">
           Manage Users
        </a>
        <a href="{{route('admin.offenders')}}"
           class="bg-blue-600 text-white text-center py-3 rounded shadow hover:bg-blue-700 transition">
           Manage Offenders
        </a>
        <a href="{{ route('admin.reports') }}"
           class="bg-green-600 text-white text-center py-3 rounded shadow hover:bg-green-700 transition">
           View Reports
        </a>
        <a href="{{ route('admin.extorters.index') }}"
           class="bg-purple-600 text-white text-center py-3 rounded shadow hover:bg-purple-700 transition">
           Manage Extortion Reports
        </a>
        <a href="{{ route('admin.representatives.index') }}"
           class="bg-indigo-600 text-white text-center py-3 rounded shadow hover:bg-indigo-700 transition relative">
           Manage Representatives
            @if($pendingReps > 0)
                <span class="absolute top-0 right-0 -mt-2 -mr-2 px-2 py-1 bg-red-500 text-white text-xs rounded-full">{{ $pendingReps }}</span>
            @endif
        </a>
    </div>

    <!-- Example "Hello Admin" or Additional Info -->
    <div class="mt-8 bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Welcome, Admin!</h2>
        <p class="text-gray-700">
            This is your central dashboard. You can quickly review user counts, offender listings, and incoming reports.
            Use the links above to manage each section.
        </p>
    </div>
</div>
@endsection
