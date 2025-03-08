@extends('layouts.admin')
@section('page_title','Edit Offender')
@section('page_content')
<div class="container flex w-full flex-col justify-center items-center mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-4">
        Edit Offender (ID: {{ $offender->id }})
    </h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Form -->
    <div class="bg-white shadow rounded-lg w-[80vw] p-6 max-w-2xl">
        <form action="{{ route('admin.offender.update', $offender->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $offender->name) }}"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                    required
                >
            </div>

            <!-- Report ID -->
            <div>
                <label for="report_id" class="block text-sm font-semibold text-gray-700">Report ID</label>
                <input
                    type="number"
                    name="report_id"
                    id="report_id"
                    value="{{ old('report_id', $offender->report_id) }}"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >
                <p class="text-xs text-gray-500 mt-1">
                    If this offender is linked to a report, enter the report's ID.
                </p>
            </div>

            <!-- Age -->
            <div>
                <label for="age" class="block text-sm font-semibold text-gray-700">Age</label>
                <input
                    type="number"
                    name="age"
                    id="age"
                    value="{{ old('age', $offender->age) }}"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >
            </div>

            <!-- Gender -->
            <div>
                <label for="gender" class="block text-sm font-semibold text-gray-700">Gender</label>
                <select
                    name="gender"
                    id="gender"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >
                    <option value="">Select</option>
                    <option value="male" {{ old('gender', $offender->gender) === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $offender->gender) === 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $offender->gender) === 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Crime Description -->
            <div>
                <label for="crime_description" class="block text-sm font-semibold text-gray-700">Crime Description</label>
                <textarea
                    name="crime_description"
                    id="crime_description"
                    rows="3"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >{{ old('crime_description', $offender->crime_description) }}</textarea>
            </div>

            <!-- Offense Type -->
            <div>
                <label for="offense_type" class="block text-sm font-semibold text-gray-700">Offense Type</label>
                <input
                    type="text"
                    name="offense_type"
                    id="offense_type"
                    value="{{ old('offense_type', $offender->offense_type) }}"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700">Location</label>
                <input
                    type="text"
                    name="location"
                    id="location"
                    value="{{ old('location', $offender->location) }}"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
                <input
                    type="text"
                    name="status"
                    id="status"
                    value="{{ old('status', $offender->status) }}"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >
                <p class="text-xs text-gray-500 mt-1">Example: "allegedly", "convicted", etc.</p>
            </div>

            <!-- Evidence -->
            <div>
                <label for="evidence" class="block text-sm font-semibold text-gray-700">Evidence</label>
                <textarea
                    name="evidence"
                    id="evidence"
                    rows="3"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >{{ old('evidence', $offender->evidence) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Paths or descriptions of evidence, if any.</p>
            </div>

            <!-- Risk Level -->
            <div>
                <label for="risk_level" class="block text-sm font-semibold text-gray-700">Risk Level</label>
                <input
                    type="text"
                    name="risk_level"
                    id="risk_level"
                    value="{{ old('risk_level', $offender->risk_level) }}"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >
                <p class="text-xs text-gray-500 mt-1">Example: "low", "medium", "high".</p>
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button
                    type="submit"
                    class="bg-red-600 text-white px-6 py-2 rounded shadow hover:bg-red-700 transition"
                >
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
