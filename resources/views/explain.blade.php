@extends('layouts.user')
@section('page_title','কিভাবে এটি কাজ করে | How it Works')
@section('page_content')
<div class="w-full bg-white">

    <!-- Header Section -->
    <header class="bg-red-600 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-xl md:text-2xl font-bold uppercase tracking-wider">
                How It Works
            </h1>
        </div>
    </header>

    <!-- Main Container -->
    <main class="container mx-auto px-4 py-8">

        <!-- Section 1: Bangla -->
        <div class="bg-white shadow-md p-6 rounded-lg mb-8">
            <h2 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide mb-4">
                সচেতন.org - কিভাবে প্ল্যাটফর্ম কাজ করে
            </h2>
            <p class="text-gray-700 mb-4">
                <strong>সচেতন.org</strong> হলো একটি উন্মুক্ত ডিজিটাল প্ল্যাটফর্ম, যেখানে সাধারণ মানুষ যৌন নির্যাতন বা অপরাধের ঘটনা সম্পর্কে তথ্য জমা দিতে পারে। আমাদের লক্ষ্য হলো সমাজে যৌন অপরাধ সম্পর্কে সচেতনতা বৃদ্ধি করা এবং অপরাধীদের সম্পর্কে যাচাই করা সহজ করা।
            </p>

            <!-- Steps List -->
            <ol class="list-decimal list-inside space-y-4 text-gray-700">
                <li>
                    <span class="font-semibold">অ্যাকাউন্ট তৈরি / লগইন:</span>  
                    আপনি প্রথমে আপনার ফোন নম্বর বা ইমেইল ব্যবহার করে একটি অ্যাকাউন্ট তৈরি করতে পারেন। সফলভাবে নিবন্ধন করার পরে, প্ল্যাটফর্মে লগইন করুন।
                </li>
                <li>
                    <span class="font-semibold">প্রতিবেদন জমা দেওয়া:</span>  
                    "ঘটনা রিপোর্ট করুন" বোতাম ক্লিক করে একটি ফর্ম খুলুন। সেখানে ঘটনার ধরন, অবস্থান, সময়, ও অন্যান্য প্রয়োজনীয় তথ্য লিখুন। প্রমাণ বা ছবি থাকলে সেগুলো আপলোড করুন। চাইলে পরিচয় গোপন রাখতে পারেন।
                </li>
                <li>
                    <span class="font-semibold">ডেটাবেসে সংরক্ষণ:</span>  
                    আপনার জমা দেওয়া তথ্য সুরক্ষিত ডেটাবেসে সংরক্ষণ করা হয়। আমরা আপনার ব্যক্তিগত তথ্য নিরাপদ রাখার জন্য সর্বোচ্চ গুরুত্ব দিই।
                </li>
                <li>
                    <span class="font-semibold">যাচাই ও পর্যালোচনা:</span>  
                    মডারেশন টিম রিপোর্ট যাচাই করে এবং প্রাথমিকভাবে গ্রহণ করে। প্রয়োজনে স্থানীয় সংগঠন, আইন প্রয়োগকারী সংস্থা বা অন্যান্য সূত্রের সাথে সমন্বয় করে ঘটনাটি যাচাই করা হয়।
                </li>
                <li>
                    <span class="font-semibold">প্রকাশ ও সচেতনতা:</span>  
                    যাচাই সম্পন্ন হলে অপরাধীর তথ্য ও ঘটনার সারসংক্ষেপ (প্রয়োজনীয় ক্ষেত্রসমূহে) প্রকাশ করা হয়। যৌন অপরাধ সম্পর্কে সমাজে সচেতনতা বাড়াতে মানচিত্র, পরিসংখ্যান ইত্যাদি উপস্থাপন করা হয়।
                </li>
            </ol>

            <!-- Why It Matters -->
            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-2">
                কেন এটি গুরুত্বপূর্ণ
            </h3>
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                <li><strong>নিরাপত্তা:</strong> মানুষ যেন তাদের এলাকায় যৌন অপরাধ সম্পর্কে আগেভাগে জানতে পারে।</li>
                <li><strong>সচেতনতা:</strong> যৌন নির্যাতন নিয়ে খোলাখুলি আলোচনা ও প্রতিরোধ গড়ে তোলা।</li>
                <li><strong>সহায়তা:</strong> ভুক্তভোগীদের পাশে দাঁড়ানো এবং প্রয়োজনীয় আইনগত ও মনোসামাজিক সাপোর্টের সাথে সংযুক্ত করা।</li>
            </ul>
        </div>

        <!-- Section 2: English -->
        <div class="bg-white shadow-md p-6 rounded-lg">
            <h2 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide mb-4">
                Shocheton.org - How This Platform Works
            </h2>
            <p class="text-gray-700 mb-4">
                <strong>Shocheton.org</strong> is an open digital platform where the public can submit information about sexual offenses or abuse. Our goal is to increase awareness of sexual crimes in society and make it easier to check records about offenders.
            </p>

            <!-- Steps List -->
            <ol class="list-decimal list-inside space-y-4 text-gray-700">
                <li>
                    <span class="font-semibold">Create an Account / Login:</span>  
                    Start by creating an account using your phone number or email. After successful registration, log in to the platform.
                </li>
                <li>
                    <span class="font-semibold">Submit a Report:</span>  
                    Click on the "Report an Incident" button to open a form. Fill in details like the type of incident, location, time, and any other relevant information. Upload evidence or photos if you have them. You may remain anonymous if you prefer.
                </li>
                <li>
                    <span class="font-semibold">Data Storage:</span>  
                    The information you submit is stored in a secure database. We prioritize the security of your personal details.
                </li>
                <li>
                    <span class="font-semibold">Review & Verification:</span>  
                    Our moderation team initially reviews the report. If needed, we coordinate with local organizations, law enforcement, or other sources to further verify the incident.
                </li>
                <li>
                    <span class="font-semibold">Publication & Awareness:</span>  
                    After verification, offender details and a summary of the incident may be published (if permissible). We also share maps, statistics, or summarized data to raise awareness about sexual offenses.
                </li>
            </ol>

            <!-- Why It Matters -->
            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-2">
                Why It Matters
            </h3>
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                <li><strong>Safety:</strong> Allows people to stay informed about sexual offenses in their area.</li>
                <li><strong>Awareness:</strong> Encourages open dialogue around sexual abuse or crimes.</li>
                <li><strong>Support & Resources:</strong> Stands by survivors, connecting them with legal aid and psychosocial support organizations.</li>
            </ul>
        </div>

    </main>
</div>
@endsection