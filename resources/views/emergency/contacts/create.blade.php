@extends('layouts.user')

@section('page_title','Add Emergency Contact | Shocheton.org')

@section('page_content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center flex-wrap text-sm sm:text-base space-x-2 mb-6">
        <!-- Breadcrumb link -->
        <a href="{{ route('emergency.contacts') }}" class="text-gray-600 hover:text-gray-800 font-semibold">
            Emergency Contacts
        </a>
        <!-- Separator -->
        <span class="text-gray-400">/</span>
        <!-- Current page heading -->
        <h1 class="text-xl sm:text-2xl font-bold">
            Add Emergency Contact
        </h1>
    </div>
    

    <!-- Display success message if redirected from store -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-200 text-red-800 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('emergency_contacts.store') }}" method="POST" class="max-w-lg mx-auto">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block font-semibold text-gray-700 mb-2">Name</label>
            <input 
                type="text"
                name="name"
                id="name"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
                value="{{ old('name') }}"
                required
            >
        </div>

        <!-- Relation -->
        <div class="mb-4">
            <label for="relation" class="block font-semibold text-gray-700 mb-2">Relation</label>
            <select
                name="relation"
                id="relation"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
                required
            >
                <option value="" disabled selected>Select Relation</option>
                <option value="parent"    {{ old('relation') == 'parent'    ? 'selected' : '' }}>Parent</option>
                <option value="spouse"    {{ old('relation') == 'spouse'    ? 'selected' : '' }}>Spouse</option>
                <option value="child"     {{ old('relation') == 'child'     ? 'selected' : '' }}>Child</option>
                <option value="sibling"   {{ old('relation') == 'sibling'   ? 'selected' : '' }}>Sibling</option>
                <option value="guardian"  {{ old('relation') == 'guardian'  ? 'selected' : '' }}>Guardian</option>
                <option value="relative"  {{ old('relation') == 'relative'  ? 'selected' : '' }}>Relative</option>
                <option value="friend"    {{ old('relation') == 'friend'    ? 'selected' : '' }}>Friend</option>
                <option value="colleague" {{ old('relation') == 'colleague' ? 'selected' : '' }}>Colleague</option>
                <option value="neighbor"  {{ old('relation') == 'neighbor'  ? 'selected' : '' }}>Neighbor</option>
                <option value="other"     {{ old('relation') == 'other'     ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label for="phone" class="block font-semibold text-gray-700 mb-2">Phone</label>
            <input 
                type="text"
                name="phone"
                id="phone"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
                value="{{ old('phone') }}"
                required
            >
        </div>

        <!-- Email (Optional) -->
        <div class="mb-6">
            <label for="email" class="block font-semibold text-gray-700 mb-2">Email (Optional)</label>
            <input 
                type="email"
                name="email"
                id="email"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
                value="{{ old('email') }}"
            >
        </div>

        <!-- Submit -->
        <div class="text-right">
            <button 
                type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded shadow"
            >
                Add Contact
            </button>
        </div>
    </form>
</div>
@endsection
