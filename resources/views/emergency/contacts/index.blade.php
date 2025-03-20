@extends('layouts.user')
@section('page_title','Emergency Contacts | Shocheton.org')
@section('page_content')
<!-- Display success message if any -->
@if(session('success'))
<div class="bg-green-100 border border-green-200 text-green-800 px-4 py-2 rounded mb-4">
    {{ session('success') }}
</div>
@endif
<div class="container mx-auto px-4 py-8">
    <!-- Page Heading -->
    <div class="flex flex-col sm:flex-row items-center justify-between mb-6 gap-4">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">
            Emergency Contacts
        </h1>
        <!-- "Add New Contact" Button -->
        <a 
            href="{{ route('emergency_contacts.create') }}"
            class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded shadow"
        >
            + Add New Contact
        </a>
    </div>


    <!-- Contacts Table -->
<div class="overflow-x-auto">
    <table class="w-full table-auto bg-white rounded shadow">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-600 uppercase tracking-wider">
                    Name
                </th>
                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-600 uppercase tracking-wider">
                    Relation
                </th>
                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-600 uppercase tracking-wider">
                    Phone
                </th>
                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-600 uppercase tracking-wider">
                    Email
                </th>
                <th class="px-4 sm:px-6 py-3 text-right text-xs sm:text-sm font-medium text-gray-600 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($emergencyContacts as $contact)
                <tr class="border-b border-gray-200">
                    <td class="px-4 sm:px-6 py-4 text-gray-800 text-sm">
                        {{ $contact->name }}
                    </td>
                    <td class="px-4 sm:px-6 py-4 text-gray-800 text-sm">
                        {{ ucfirst($contact->relation) }}
                    </td>
                    <td class="px-4 sm:px-6 py-4 text-gray-800 text-sm">
                        {{ $contact->phone }}
                    </td>
                    <td class="px-4 sm:px-6 py-4 text-gray-800 text-sm">
                        {{ $contact->email }}
                    </td>
                    <td class="px-4 sm:px-6 py-4 text-right">
                        <!-- Edit -->
                        <a 
                            href="{{ route('emergency_contacts.edit', $contact) }}"
                            class="text-blue-600 hover:text-blue-800 mr-3"
                        >
                            Edit
                        </a>
                        <!-- Delete -->
                        <form 
                            action="{{ route('emergency_contacts.destroy', $contact) }}"
                            method="POST"
                            class="inline-block"
                        >
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="text-red-600 hover:text-red-800"
                            >
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 sm:px-6 py-4 text-center text-gray-700 text-sm">
                        No emergency contacts found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</div>
@endsection
