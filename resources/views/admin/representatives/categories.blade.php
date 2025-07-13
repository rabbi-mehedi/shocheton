@extends('layouts.admin')

@section('page_content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">Assign Categories to {{ $representative->user->name }}</h2>
        </div>

        <div class="my-4">
            <form action="{{ route('admin.representatives.categories.sync', $representative) }}" method="POST">
                @csrf
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse ($categories as $category)
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    class="form-checkbox h-5 w-5 text-blue-600"
                                    @if(in_array($category->id, $assignedCategories)) checked @endif>
                                <span class="text-gray-700">{{ $category->name }}</span>
                            </label>
                        @empty
                            <p class="text-gray-500">No categories found. Please create some categories first.</p>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Categories
                        </button>
                        <a href="{{ route('admin.representatives.index') }}" class="ml-4 text-gray-600">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 