@extends('layouts.user')
@section('page_title','Dashboard | Shocheton.org')
@section('page_content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                @if (auth()->user()->isAdmin())
                    <livewire:admin-menu></livewire:admin-menu>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection