@extends('layouts.user')
@section('page_title','লিগ্যাল এইড | Legal Aid')
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
                Legal Aid Resources
            </h1>
        </div>
    </header>

    <!-- Legal Aid Organizations -->
    <div class="container mx-auto px-4 max-w-5xl space-y-6">

        <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">BLAST (Bangladesh Legal Aid and Services Trust)</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">BLAST is one of the largest legal aid organizations in Bangladesh, which works to ensure access to justice for marginalized groups, including survivors of sexual violence. BLAST provides free legal services, including litigation, mediation, and legal awareness, focusing on gender-based violence, including sexual offenses.</p>
            <a href="https://blast.org.bd/" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
                Visit Website &rarr;
            </a>
        </div>

        <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">Ain o Salish Kendra (ASK)</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">ASK provides legal support and representation to victims of sexual violence and other human rights violations. They also conduct public interest litigation and offer legal counseling. Their broader mission is to ensure social and gender justice by protecting and promoting human rights, focusing heavily on violence against women and girls.</p>
            <a href="https://www.askbd.org/ask/" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
                Visit Website &rarr;
            </a>
        </div>

        <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">Bangladesh National Women Lawyers’ Association (BNWLA)</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">BNWLA is a prominent organization providing legal aid and advocacy for women and children, particularly survivors of sexual violence and exploitation. It aims to protect and promote the legal and human rights of women and children through legal aid, policy advocacy, and social mobilization.</p>
            <a href="https://bnwla-bd.org/" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
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
