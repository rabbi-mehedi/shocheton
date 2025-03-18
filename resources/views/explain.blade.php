@extends('layouts.user')
@section('page_title','কিভাবে এটি কাজ করে | How it Works')
@section('page_content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="w-full flex justify-center flex-col items-center bg-white">
    <a href="{{route('home')}}">
        <img src="{{asset('wide_logo.png')}}" alt="shocheton.org" class="my-6 h-[10vh]">
    </a>

    <!-- Header Section -->
    <header class="bg-red-600 text-white py-6 mb-2">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-xl md:text-2xl font-bold uppercase tracking-wider">
                How It Works
            </h1>
        </div>

    </header>

     <!-- Language Switcher Buttons -->
     <div class="mb-4">
        <button id="banglaBtn" class="px-4 py-2 bg-red-600 text-white rounded-l">বাংলা</button>
        <button id="englishBtn" class="px-4 py-2 bg-red-600 text-white rounded-r">English</button>
    </div>

    <!-- Main Container -->
    <main class="container mx-auto px-4 py-8">

        <!-- Section 1: Bangla How it Works (Visible by Default)-->
        <div id="banglaSection" class="bg-white shadow-md p-6 rounded-lg mb-8">
            <h2 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide mb-4 accordion-header">
                সচেতন.org - কিভাবে প্ল্যাটফর্ম কাজ করে 
                <i class="fas fa-chevron-down ml-2 rotate-0 accordion-arrow"></i>
            </h2>
                
            <div class="accordion-content hidden">
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
        </div>

        <!-- Section 2: Bangla FAQ (Visible by Default) -->
        <div id="banglaFAQ" class="bg-white shadow-md p-6 rounded-lg mb-8">
            <h2 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide mb-4 accordion-header">
                প্রায়শই জিজ্ঞাসিত প্রশ্নাবলী
                <i class="fas fa-chevron-down ml-2 rotate-0 accordion-arrow"></i>
            </h2>
            <div class="accordion-content hidden">
                <!-- FAQ List -->
                <ul class="list-decimal list-inside space-y-4 text-gray-700">
                    <li>
                        <span class="font-semibold">তথ্য প্রকাশের আগে কিভাবে যাচাই করা হয়?</span>  
                        প্রতিটি রিপোর্ট একটি পর্যালোচনা প্রক্রিয়ার মধ্য দিয়ে যায়, যেখানে মডারেশন টিম সেটি পর্যালোচনা করে। তবে, আমরা ব্যবহারকারীদের প্রমাণিত প্রমাণ জমা দিতে উত্সাহিত করি এবং বিশ্বাসযোগ্যতা না থাকা রিপোর্টগুলো বাতিল করতে পারি।
                    </li>
                    <li>
                        <span class="font-semibold">কেউ কি রিপোর্ট জমা দিতে পারে?</span>  
                        হ্যাঁ, রিপোর্ট ভুক্তভোগী, সাক্ষী, আত্মীয় বা উদ্বিগ্ন ব্যক্তি জমা দিতে পারে। তবে, মিথ্যা রিপোর্ট জমা দেওয়া কঠোরভাবে নিষিদ্ধ।
                    </li>
                    <li>
                        <span class="font-semibold">রিপোর্ট জমা দেওয়ার জন্য কি তথ্য দরকার?</span>  
                        আপনাকে অভিযুক্ত ব্যক্তির নাম, স্থান, ঘটনা সম্পর্কে বর্ণনা এবং যে কোনো প্রমাণ (ফটো, ভিডিও, ডকুমেন্ট ইত্যাদি) প্রদান করতে হবে।
                    </li>
                    <li>
                        <span class="font-semibold">যদি কেউ মিথ্যা অভিযুক্ত হয়, তাহলে কি হবে?</span>  
                        যেসব ব্যক্তি মনে করেন তাদের বিরুদ্ধে ভুলভাবে অভিযোগ করা হয়েছে, তারা প্রমাণ সহ আপিল করতে পারেন। আমরা এমন দাবিগুলি পর্যালোচনা করব এবং মিথ্যা অভিযোগগুলি অপসারণ করব যদি সেগুলি যাচাই হয়।
                    </li>
                    <li>
                        <span class="font-semibold">যদি আমি রিপোর্ট জমা দিই, তাহলে কি আমার পরিচয় সুরক্ষিত থাকবে?</span>  
                        হ্যাঁ, আপনি আপনার পরিচয় গোপন রাখতে পারেন। তবে, যদি আরও স্পষ্টতার প্রয়োজন হয়, তবে আমরা যোগাযোগের বিস্তারিত দেওয়ার পরামর্শ দিই।
                    </li>
                    <li>
                        <span class="font-semibold">কীভাবে পূর্ববর্তী ঘটনা রিপোর্ট করা যাবে?</span>  
                        হ্যাঁ, অতীতের ঘটনা রিপোর্ট করা যেতে পারে, তবে যতো বেশি সাম্প্রতিক এবং ভালোভাবে ডকুমেন্ট করা হবে, ততো বেশি বিশ্বাসযোগ্যতা পাবে।
                    </li>
                    <li>
                        <span class="font-semibold">যদি আমি আমার নাম এই সাইটে দেখতে পাই, তবে কি করব?</span>  
                        আপনি একটি পর্যালোচনার আবেদন করতে পারেন এবং অভিযোগ চ্যালেঞ্জ করার জন্য প্রমাণ সরবরাহ করতে পারেন। আমরা ন্যায়বিচার এবং সঠিকতা নিশ্চিত করতে প্রতিশ্রুতিবদ্ধ।
                    </li>
                    <li>
                        <span class="font-semibold">আমি কি এই সাইট ব্যবহার না করে সরাসরি আইন প্রয়োগকারী সংস্থার সাথে যোগাযোগ করতে পারি?</span>  
                        অবশ্যই। আমরা ভুক্তভোগীদের আইনগত পদক্ষেপ নেওয়ার জন্য সরাসরি পুলিশে রিপোর্ট করার জন্য উত্সাহিত করি। এই রেজিস্ট্রি জনসাধারণের সচেতনতার জন্য, আইন ব্যবস্থার বিকল্প নয়।
                    </li>
                    <li>
                        <span class="font-semibold">আমি যদি কাউকে রিপোর্ট করতে চাই, তবে কীভাবে আমার নিরাপত্তা নিশ্চিত করব?</span>  
                        যদি আপনি প্রতিশোধের ভয়ে থাকেন, তবে আপনি অজ্ঞাতনামা রিপোর্ট জমা দেওয়ার কথা ভাবতে পারেন এবং সংবেদনশীল ব্যক্তিগত তথ্য প্রকাশ করা এড়িয়ে চলুন।
                    </li>
                    <li>
                        <span class="font-semibold">এই প্ল্যাটফর্ম ব্যবহারকারীদের জন্য কোন আইনি ঝুঁকি রয়েছে?</span>  
                        ব্যবহারকারীদের নিশ্চিত করতে হবে যে তাদের জমা দেওয়া তথ্য সঠিক। মিথ্যা অভিযোগ আইনি ফলস্বরূপ আসতে পারে, যার মধ্যে মানহানির মামলা অন্তর্ভুক্ত হতে পারে।
                    </li>
                    <li>
                        <span class="font-semibold">কীভাবে আমি এই সাইট থেকে আমার তথ্য মুছে ফেলতে পারি?</span>  
                        যারা মনে করেন তাদের তথ্য ভুলভাবে তালিকাভুক্ত হয়েছে, তারা প্রাসঙ্গিক প্রমাণ সহ একটি আপিল করতে পারেন। আমাদের টিম এটি মূল্যায়ন করবে এবং প্রয়োজনীয় পদক্ষেপ নেবে।
                    </li>
                </ul>
            </div>
        </div>


        <!-- Section 3: English How it Works (Hidden by Default) -->
        <div id="englishSection" class="bg-white shadow-md p-6 rounded-lg mb-8 hidden">
            <h2 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide mb-4 accordion-header">
                Shocheton.org - How This Platform Works
                <i class="fas fa-chevron-down ml-2 rotate-0 accordion-arrow"></i>
            </h2>

            <div class="accordion-content hidden">
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
        </div>

        <!-- Section 4: English FAQ (Hidden by Default) -->
        <div id="englishFAQ"class="bg-white shadow-md p-6 rounded-lg mb-8 hidden">
            <h2 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide mb-4 accordion-header">
                Frequently Asked Questions
                <i class="fas fa-chevron-down ml-2 rotate-0 accordion-arrow"></i>
            </h2>

            <div class="accordion-content hidden">
                <!-- FAQ List -->
                <ul class="list-decimal list-inside space-y-4 text-gray-700">
                    <li>
                        <span class="font-semibold">How is information verified before being published?</span>  
                        Each submission undergoes a review process by the moderation team before being posted. However, we encourage users to provide supporting evidence, and we reserve the right to reject submissions lacking credibility.
                    </li>
                    <li>
                        <span class="font-semibold">Can anyone submit a report?</span>  
                        Yes, reports can be submitted by victims, witnesses, relatives, or concerned individuals. However, false reporting is strictly prohibited.
                    </li>
                    <li>
                        <span class="font-semibold">What information do I need to submit a report?</span>  
                        You should provide details such as the accused person’s name, location, a description of the incident, and any supporting evidence (photos, videos, documents, etc.).
                    </li>
                    <li>
                        <span class="font-semibold">What happens if someone is falsely accused?</span>  
                        Individuals who believe they have been wrongly listed can submit an appeal with evidence proving their innocence. We will review such claims and remove false accusations if validated.
                    </li>
                    <li>
                        <span class="font-semibold">Is my identity protected if I submit a report?</span>  
                        Yes, you may choose to remain anonymous. However, we recommend providing contact details in case we need further clarification.
                    </li>
                    <li>
                        <span class="font-semibold">Can I report a past incident?</span>  
                        Yes, historical cases can be reported, but the more recent and well-documented the report, the more credible it will be.
                    </li>
                    <li>
                        <span class="font-semibold">What should I do if I see my name on this website?</span>  
                        You can request a review and provide supporting documents to challenge the accusation. We are committed to fairness and accuracy.
                    </li>
                    <li>
                        <span class="font-semibold">Can I contact law enforcement instead of using this website?</span>  
                        Absolutely. We encourage victims to report cases directly to the police for legal action. This registry is meant for public awareness, not a replacement for the legal system.
                    </li>
                    <li>
                        <span class="font-semibold">How can I ensure my safety when reporting someone?</span>  
                        If you fear retaliation, consider submitting your report anonymously and avoid revealing sensitive personal information.
                    </li>
                    <li>
                        <span class="font-semibold">What legal risks exist for users of this platform?</span>  
                        Users must ensure that their submissions are truthful. False accusations could result in legal consequences, including defamation lawsuits.
                    </li>
                    <li>
                        <span class="font-semibold">How can I remove my information from this site?</span>  
                        Individuals can submit an appeal with relevant evidence proving the inaccuracy of the report. Our team will assess and take necessary action.
                    </li>
                </ul>
            </div>
        </div>

    </main>
</div>

<script>
    // Language switching functionality
    document.getElementById('banglaBtn').addEventListener('click', function() {
        document.getElementById('banglaSection').classList.remove('hidden');
        document.getElementById('banglaFAQ').classList.remove('hidden');
        document.getElementById('englishSection').classList.add('hidden');
        document.getElementById('englishFAQ').classList.add('hidden');
    });

    document.getElementById('englishBtn').addEventListener('click', function() {
        document.getElementById('banglaSection').classList.add('hidden');
        document.getElementById('banglaFAQ').classList.add('hidden');
        document.getElementById('englishSection').classList.remove('hidden');
        document.getElementById('englishFAQ').classList.remove('hidden');
    });

    document.addEventListener("DOMContentLoaded", function () {
    const accordionHeaders = document.querySelectorAll('.accordion-header');

    accordionHeaders.forEach(header => {
        header.addEventListener('click', function () {
            const content = this.nextElementSibling;
            content.classList.toggle('show');

            const icon = this.querySelector('.accordion-arrow');
            icon.classList.toggle('rotate-180');
            });
        });
    })

</script>
@endsection

<style>
.accordion-header {
    cursor: pointer;
}

.accordion-content {
    display: none;
}

.accordion-content.show {
    display: block;
}
.accordion-arrow.rotate-180 {
    transform: rotate(180deg);
}
</style>