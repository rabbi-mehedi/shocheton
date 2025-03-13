@extends('layouts.admin')
@section('page_title','Edit Report')
@section('page_content')
<div class="container flex w-full flex-col justify-center items-center mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-4">Edit Report (ID: {{ $report->id }})</h1>

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
        <form action="{{ route('admin.report.update', $report->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Offender ID -->
            <div>
                <label for="offender_id" class="block text-sm font-semibold text-gray-700">Offender Name</label>
                
                <input
                    type="text"
                    name="offender_id"
                    disabled
                    id="offender_id"
                    value="{{ old('offender_id', $report->offender->name) }}"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >
                <p class="text-xs text-gray-500 mt-1">Enter a valid offender ID (or leave blank if none).</p>
            </div>

            <!-- Offender Relation -->
            <div>
                <label for="offender_relation_to_victim" class="block text-sm font-semibold text-gray-700">
                    Offender Relation to Victim
                </label>
                <select
                    name="offender_relation_to_victim"
                    id="offender_relation_to_victim"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >
                    <!-- Adjust these options to match your enum values -->
                    <option value="Stranger" {{ old('offender_relation_to_victim', $report->offender_relation_to_victim) === 'Stranger' ? 'selected' : '' }}>Stranger</option>
                    <option value="Family Member" {{ old('offender_relation_to_victim', $report->offender_relation_to_victim) === 'Family Member' ? 'selected' : '' }}>Family Member</option>
                    <option value="Teacher" {{ old('offender_relation_to_victim', $report->offender_relation_to_victim) === 'Teacher' ? 'selected' : '' }}>Teacher</option>
                    <option value="Colleague" {{ old('offender_relation_to_victim', $report->offender_relation_to_victim) === 'Colleague' ? 'selected' : '' }}>Colleague</option>
                    <option value="Neighbor" {{ old('offender_relation_to_victim', $report->offender_relation_to_victim) === 'Neighbor' ? 'selected' : '' }}>Neighbor</option>
                    <option value="Partner/Spouse" {{ old('offender_relation_to_victim', $report->offender_relation_to_victim) === 'Partner/Spouse' ? 'selected' : '' }}>Partner/Spouse</option>
                    <option value="Religious Leader" {{ old('offender_relation_to_victim', $report->offender_relation_to_victim) === 'Religious Leader' ? 'selected' : '' }}>Religious Leader</option>
                    <option value="Police/Authority" {{ old('offender_relation_to_victim', $report->offender_relation_to_victim) === 'Police/Authority' ? 'selected' : '' }}>Police/Authority</option>
                    <option value="Other" {{ old('offender_relation_to_victim', $report->offender_relation_to_victim) === 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Police Status -->
            <div>
                <label for="police_status" class="block text-sm font-semibold text-gray-700">Police Status</label>
                <select
                    name="police_status"
                    id="police_status"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >
                    <!-- Adjust to your enum: unreported, in-progress, reported -->
                    <option value="unreported" {{ old('police_status', $report->police_status) === 'unreported' ? 'selected' : '' }}>Unreported</option>
                    <option value="in-progress" {{ old('police_status', $report->police_status) === 'in-progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="reported" {{ old('police_status', $report->police_status) === 'reported' ? 'selected' : '' }}>Reported</option>
                </select>
            </div>

            <!-- Police Station -->
            <div>
                <label for="police_station" class="block text-sm font-semibold text-gray-700">Police Station</label>
                <input
                    type="text"
                    name="police_station"
                    id="police_station"
                    value="{{ old('police_station', $report->police_station) }}"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >
            </div>

            <!-- Needs Legal Support -->
            <div class="flex items-center">
                <input
                    type="checkbox"
                    name="needs_legal_support"
                    id="needs_legal_support"
                    value="1"
                    class="h-4 w-4 text-red-600 focus:ring-red-400 border-gray-300 rounded"
                    {{ old('needs_legal_support', $report->needs_legal_support) ? 'checked' : '' }}
                >
                <label for="needs_legal_support" class="ml-2 text-sm text-gray-700">Needs Legal Support</label>
            </div>

            <!-- Needs NGO Support -->
            <div class="flex items-center">
                <input
                    type="checkbox"
                    name="needs_ngo_support"
                    id="needs_ngo_support"
                    value="1"
                    class="h-4 w-4 text-red-600 focus:ring-red-400 border-gray-300 rounded"
                    {{ old('needs_ngo_support', $report->needs_ngo_support) ? 'checked' : '' }}
                >
                <label for="needs_ngo_support" class="ml-2 text-sm text-gray-700">Needs NGO Support</label>
            </div>

            <!-- Privacy Level -->
            <div>
                <label for="privacy_level" class="block text-sm font-semibold text-gray-700">Privacy Level</label>
                <select
                    name="privacy_level"
                    id="privacy_level"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >
                    <option value="public" {{ old('privacy_level', $report->privacy_level) === 'public' ? 'selected' : '' }}>Public</option>
                    <option value="private" {{ old('privacy_level', $report->privacy_level) === 'private' ? 'selected' : '' }}>Private</option>
                </select>
            </div>

            <!-- Contact Permission -->
            <div class="flex items-center">
                <input
                    type="checkbox"
                    name="contact_permission"
                    id="contact_permission"
                    value="1"
                    class="h-4 w-4 text-red-600 focus:ring-red-400 border-gray-300 rounded"
                    {{ old('contact_permission', $report->contact_permission) ? 'checked' : '' }}
                >
                <label for="contact_permission" class="ml-2 text-sm text-gray-700">Contact Permission</label>
            </div>

            <!-- Additional Details -->
            <div>
                <label for="additional_details" class="block text-sm font-semibold text-gray-700">Additional Details</label>
                <textarea
                    name="additional_details"
                    id="additional_details"
                    rows="4"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                >{{ old('additional_details', $report->additional_details) }}</textarea>
            </div>

            <!-- Verified -->
            <div class="flex items-center">
                <input
                    type="checkbox"
                    name="verified"
                    id="verified"
                    value="1"
                    class="h-4 w-4 text-red-600 focus:ring-red-400 border-gray-300 rounded"
                    {{ old('verified', $report->verified) ? 'checked' : '' }}
                >
                <label for="verified" class="ml-2 text-sm text-gray-700">Verified</label>
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
