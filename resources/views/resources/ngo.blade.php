@extends('layouts.user')
@section('page_title','এনজিও সহায়তা | NGO Support')
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
                NGO Support Resources
            </h1>
        </div>
    </header>

    <!-- NGO Support Organizations -->
    <div class="container mx-auto px-4 max-w-5xl space-y-6">

        <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">Bangladesh Mahila Parishad</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">One of the largest women's rights organizations in Bangladesh, BMP focuses on empowering women, advocating for gender equality, and addressing violence against women, including sexual violence. BMP also engages in policy advocacy, legal reform, and community mobilization.</p>
            <a href="https://mahilaparishad.org/" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
                Visit Website &rarr;
            </a>
        </div>

        <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">Bangladesh Nari Pragati Sangha (BNPS)</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">BNPS works on women’s empowerment, gender equality, and human rights, especially focusing on violence against women. They operate various community-based programs that support survivors of sexual offenses through awareness campaigns, leadership development, and socio-economic initiatives.</p>
            <a href="https://bdplatform4sdgs.net/profile/bangladesh-nari-progati-sangha/" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
                Visit Website &rarr;
            </a>
        </div>

        <div class="p-6 border-2 border-red-600 rounded-lg shadow-md bg-white transition-all duration-300 hover:bg-red-600 group animate-fade-in">
            <h2 class="text-xl font-semibold text-red-600 group-hover:text-white mb-2">Odhikar</h2>
            <p class="text-gray-700 group-hover:text-white mb-4">Odhikar is a human rights watchdog organization that documents and advocates against human rights violations, including sexual and gender-based violence. They support victims through advocacy, awareness campaigns, and by pushing for legal and institutional reforms to protect women’s rights.</p>
            <a href="https://www.omct.org/en/network-members/odhikar" target="_blank" class="inline-block text-red-600 group-hover:text-white underline font-medium transition-all duration-300">
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
