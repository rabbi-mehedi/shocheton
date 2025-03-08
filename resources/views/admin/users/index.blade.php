@extends('layouts.admin')
@section('page_title','Users | Admin Panel')
@section('page_content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-4">All Users ({{count($allUsers)}})</h1>

    <!-- If you want pagination, ensure your controller uses paginate() 
         and that you have $users->links() at the bottom -->

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Role</th>
                    <th class="px-4 py-2 text-left">Created</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($allUsers as $user)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $user->id }}</td>
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->role }}</td>
                    <td class="px-4 py-2">{{ $user->created_at->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">
                        <!-- Example "Edit" link or "View" button -->
                        <a href="#" 
                           class="text-blue-600 hover:underline">
                           Edit
                        </a>
                        <!-- Add more actions as needed (delete, view, etc.) -->
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                        No users found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- If using pagination:
    <div class="mt-4">
        {{-- {{ $users->links() }} --}}
    </div>
    -->
</div>
@endsection
