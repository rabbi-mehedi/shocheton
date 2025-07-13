@extends('layouts.user')
@section('page_title','চাঁদাবাজ প্রতিনিধি নিবন্ধন / Party Representative Registration')
@section('page_content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4 py-6 bg-white shadow-md rounded-lg">
        <!-- Page Heading -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide">
                চাঁদাবাজ প্রতিনিধি নিবন্ধন / Party Representative Registration
            </h1>
            <p class="text-gray-600 mt-2">
                অনুগ্রহ করে আপনার বিস্তারিত তথ্য প্রদান করুন এবং আবেদন জমা দিন।
                <br>
                Please provide your details and submit your application.
            </p>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <strong class="font-bold">অনুগ্রহ করে ত্রুটিগুলো ঠিক করুন / Please fix the following errors:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Registration Form -->
        <form id="repRegisterForm" action="{{ route('rep.register.submit') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700">আপনার নাম / Name:</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="নাম লিখুন / Enter your full name">
                </div>
                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700">আপনার ইমেইল / Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="ইমেইল লিখুন / Enter your email address">
                </div>
                <!-- Phone -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700">আপনার ফোন নম্বর / Phone Number:</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                        class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="০১XXXXXXXXX / e.g. 01XXXXXXXXX">
                </div>
                <!-- Party Selection -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700">রাজনৈতিক সংস্থা / Political Party:</label>
                    <select name="party_id" required
                        class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">সিলেক্ট করুন / Select a party</option>
                        @foreach($parties as $party)
                            <option value="{{ $party->id }}" @if(old('party_id') == $party->id) selected @endif>
                                {{ $party->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Designation -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700">পদবী (ঐচ্ছিক) / Designation (Optional):</label>
                    <input type="text" name="designation" value="{{ old('designation') }}"
                        class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="পদবী লিখুন / Enter your designation">
                </div>
                <!-- reCAPTCHA -->
                <div>
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_KEY') }}"></div>
                </div>
                <!-- Submit -->
                <div class="text-center pt-4">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        আবেদন করুন / Submit Application
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- Load reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection 