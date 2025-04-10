@extends('layouts.user')
@section('page_title','মেডিকেল এইড | Medical Aid')
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
                Medical Aid Resources
            </h1>
        </div>
    </header>

    <!-- Medical Aid Organizations -->
    <div class="container mx-auto px-4 max-w-5xl space-y-6">

        <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">One-Stop Crisis Centers (OCCs)</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">OCCs are government-established centers located in several medical college hospitals across Bangladesh. They provide integrated services to survivors of sexual and gender-based violence, including emergency medical treatment, forensic examination, psychological counseling, legal aid, and shelter support—all under one roof.</p>
            <a href="https://mspvaw.gov.bd/contain/15" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
                Visit Website &rarr;
            </a>
        </div>

        <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">Naripokkho</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">Naripokkho is a leading women’s rights organization that also provides health-related support for survivors of sexual violence. They work on issues of reproductive health, sexual rights, and violence against women. Naripokkho runs health and legal clinics and advocates for survivor-centered medical services and policies.</p>
            <a href="https://naripokkho.org.bd/" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
                Visit Website &rarr;
            </a>
        </div>

        <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">Marie Stopes Bangladesh</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">Marie Stopes provides sexual and reproductive healthcare services, including post-rape care and counseling services for survivors of sexual violence. They work extensively on sexual health awareness and providing medical treatment in safe and confidential environments.</p>
            <a href="https://www.mariestopes.org.bd/" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
                Visit Website &rarr;
            </a>
        </div>

        <!-- <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">BRAC Health Programme (BRAC HNPP)</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">BRAC’s Health, Nutrition, and Population Programme provides medical assistance to survivors of gender-based violence through its community health workers, clinics, and partnerships with government hospitals. BRAC also operates BRAC Community Empowerment Programme, which links survivors to medical and psychosocial services.</p>
            <a href="https://www.brac.net/program/health-nutrition-and-population-programme-hnpp/" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
                Visit Website &rarr;
            </a>
        </div> -->

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
