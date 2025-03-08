@extends('layouts.admin')
@section('page_title','Edit User Profile')
@section('page_content')
<div class="container flex w-full flex-col justify-center items-center mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-4">Edit User (ID: {{ $user->id }})</h1>

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
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $user->name) }}"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                    required
                >
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $user->email) }}"
                    class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                    required
                >
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-semibold text-gray-700">Phone</label>
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    value="{{ old('phone', $user->phone) }}"
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
                    <option value="male" {{ (old('gender', $user->gender) === 'male') ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ (old('gender', $user->gender) === 'female') ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ (old('gender', $user->gender) === 'other') ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            @if (auth()->user()->isAdmin())
                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-semibold text-gray-700">Role</label>
                    <select
                        name="role"
                        id="role"
                        class="mt-1 block w-full border border-gray-300 rounded p-2 focus:ring focus:ring-red-400"
                    >
                        <option value="user" {{ (old('role', $user->role) === 'user') ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ (old('role', $user->role) === 'admin') ? 'selected' : '' }}>Admin</option>
                        <option value="moderator" {{ (old('role', $user->role) === 'moderator') ? 'selected' : '' }}>Moderator</option>

                    </select>
                </div>
            @endif
            

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