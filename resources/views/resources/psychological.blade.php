@extends('layouts.user')
@section('page_title','মনোবৈজ্ঞানিক সহায়তা | Psychological Aid')
@section('page_content')

<div class="w-full flex justify-center flex-col items-center">
    <!-- Logo -->
    <a href="{{ route('home') }}">
        <img src="{{ asset('wide_logo.png') }}" alt="shocheton.org" class="my-6 h-[10vh]">
    </a>

    <!-- Header -->
    <header class="bg-red-600 text-white py-4 mb-6 w-full">
        <div class="container mx-auto px-4 max-w-5xl flex flex-col md:flex-row items-center justify-center">
            <h1 class="text-2xl md:text-3xl font-bold uppercase tracking-wide md:tracking-wider leading-tight text-center md:text-left">
                Psychological Aid Resources
            </h1>
        </div>
    </header>

    <!-- Psychological Aid Organizations -->
    <div class="container mx-auto px-4 max-w-5xl space-y-6">

        <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">ASK (Ain o Salish Kendra)</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">In addition to legal aid, ASK provides psychosocial counseling to survivors of sexual violence and other human rights abuses. They have trained counselors who assist victims in overcoming trauma and emotional distress caused by sexual offenses. Their aim is to ensure holistic rehabilitation and empowerment.</p>
            <a href="https://www.askbd.org/ask/" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
                Visit Website &rarr;
            </a>
        </div>

        <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">Bangladesh National Women Lawyers’ Association (BNWLA)</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">BNWLA integrates psychosocial support as part of their legal aid program for survivors of sexual and gender-based violence. They provide trauma counseling and work towards the mental well-being of women and children who have experienced abuse.</p>
            <a href="https://bnwla-bd.org/" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
                Visit Website &rarr;
            </a>
        </div>

        <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">Justice for Women Bangladesh (JFWBD)</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">JFWBD is a grassroots initiative focusing on supporting women survivors of sexual violence through community-driven projects. They often organize support groups and offer emotional and psychological support via social platforms, with an emphasis on raising awareness and providing safe spaces for survivors.</p>
            <a href="https://www.facebook.com/Project.JFWBD/" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
                Visit Website &rarr;
            </a>
        </div>

    </div>
</div>

<!-- Custom Animations -->
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.6s ease-in-out both;
    }
</style>

@endsection
