@extends('layouts.user')
@section('page_title','কিভাবে এটি কাজ করে | How it Works')
@section('page_content')
<div class="w-full flex justify-center flex-col items-center bg-white">
    <a href="{{route('home')}}">
        <img src="{{asset('wide_logo.png')}}" alt="shocheton.org" class="my-6 h-[10vh]">
    </a>
    <!-- Header Section -->
    <header class="bg-red-600 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-xl md:text-2xl font-bold uppercase tracking-wider">
                How It Works
            </h1>
        </div>

    </header>

    <div class="flex justify-center my-4">
        <button id="btn-bangla" class="relative top-0 right-0 px-4 py-2 mx-2 bg-red-600 text-white">বাংলা</button>
        <button id="btn-english" class="relative top-0 right-0 px-4 py-2 mx-2 bg-red-600 text-white">English</button>
    </div>

    <!-- Main Container -->
    <main>
        <!-- Section 1: Bangla Content (Visible by Default) -->
        <div id="bangla-content" class="bg-white shadow-md p-6 rounded-lg mb-8">
            <div class="container mx-auto px-4 py-8">
                <h2 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide mb-4">
                    সচেতন.org - কিভাবে প্ল্যাটফর্ম কাজ করে
                </h2>
                <p class="text-gray-700 mb-4">
                    <strong>সচেতন.org</strong> হলো একটি উন্মুক্ত ডিজিটাল প্ল্যাটফর্ম, যেখানে সাধারণ মানুষ যৌন নির্যাতন বা অপরাধের ঘটনা সম্পর্কে তথ্য জমা দিতে পারে...
                </p>
                <!-- Bangla Steps List -->
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

            <div class="container mx-auto px-4 py-8">
                <h2 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide mb-4">
                প্রশ্নোত্তর - প্রায়শই জিজ্ঞাসিত প্রশ্ন
                </h2>
                <ol class="list-decimal list-inside space-y-4 text-gray-700">
                    <li>
                        <span class="font-semibold">তথ্য প্রকাশের আগে কীভাবে যাচাই করা হয়?</span>  
                        প্রতিটি জমাকৃত তথ্য আমাদের মডারেশন টিম দ্বারা পর্যালোচনা করা হয়। তবে, আমরা ব্যবহারকারীদের যথাযথ প্রমাণ সরবরাহ করতে উৎসাহিত করি এবং বিশ্বাসযোগ্যতার অভাবে কোনো তথ্য প্রত্যাখ্যান করার অধিকার সংরক্ষণ করি।
                    </li>
                    <li>
                        <span class="font-semibold">কেউ কি রিপোর্ট জমা দিতে পারে?</span>  
                        হ্যাঁ, ভুক্তভোগী, সাক্ষী, আত্মীয় বা উদ্বিগ্ন ব্যক্তিরা রিপোর্ট জমা দিতে পারেন। তবে, মিথ্যা রিপোর্ট করা কঠোরভাবে নিষিদ্ধ।
                    </li>
                    <li>
                        <span class="font-semibold">রিপোর্ট জমা দিতে কী তথ্য প্রয়োজন?</span>  
                        অভিযুক্ত ব্যক্তির নাম, অবস্থান, ঘটনার বিবরণ এবং যেকোনো সহায়ক প্রমাণ (ছবি, ভিডিও, নথি ইত্যাদি) সরবরাহ করতে হবে।
                    </li>
                    <li>
                        <span class="font-semibold">কেউ ভুলভাবে অভিযুক্ত হলে কী হবে?</span>  
                        যদি কেউ মনে করেন যে তিনি ভুলভাবে তালিকাভুক্ত হয়েছেন, তবে তিনি যথাযথ প্রমাণসহ আপিল করতে পারেন। আমরা অভিযোগ পর্যালোচনা করে যাচাইযোগ্য হলে ভুল তথ্য অপসারণ করব।
                    </li>
                    <li>
                        <span class="font-semibold">আমি যদি রিপোর্ট জমা দেই তবে কি আমার পরিচয় গোপন থাকবে?</span>  
                        হ্যাঁ, আপনি চাইলে গোপন থাকতে পারেন। তবে, আমরা সুস্পষ্টতার জন্য যোগাযোগের তথ্য সরবরাহ করার পরামর্শ দিই।
                    </li>
                    <li>
                        <span class="font-semibold">আমি কি অতীতের কোনো ঘটনা রিপোর্ট করতে পারি?</span>  
                        হ্যাঁ, পুরনো ঘটনা রিপোর্ট করা যেতে পারে, তবে সাম্প্রতিক এবং ভালভাবে ডকুমেন্টেড রিপোর্ট বেশি গ্রহণযোগ্য হবে।
                    </li>
                    <li>
                        <span class="font-semibold">যদি আমি আমার নাম এই ওয়েবসাইটে দেখতে পাই তবে কী করব?</span>  
                        আপনি একটি পর্যালোচনার অনুরোধ করতে পারেন এবং অভিযুক্ত তথ্য চ্যালেঞ্জ করার জন্য যথাযথ প্রমাণ জমা দিতে পারেন। আমরা ন্যায়বিচার ও নির্ভুলতা নিশ্চিত করতে প্রতিশ্রুতিবদ্ধ।
                    </li>
                    <li>
                        <span class="font-semibold">আইন প্রয়োগকারী সংস্থার সাথে যোগাযোগ করা কি এই ওয়েবসাইট ব্যবহারের পরিবর্তে ভালো?</span>  
                        অবশ্যই। আমরা ভুক্তভোগীদের সরাসরি পুলিশের কাছে মামলা দায়ের করার জন্য উৎসাহিত করি। এই রেজিস্ট্রি জনসচেতনতামূলক এবং এটি আইনি ব্যবস্থার বিকল্প নয়।
                    </li>
                    <li>
                        <span class="font-semibold">আমি কিভাবে কাউকে রিপোর্ট করার সময় নিজের নিরাপত্তা নিশ্চিত করতে পারি?</span>  
                        যদি প্রতিশোধের আশঙ্কা থাকে, তবে রিপোর্টটি বেনামে জমা দিন এবং সংবেদনশীল ব্যক্তিগত তথ্য প্রকাশ করা থেকে বিরত থাকুন।
                    </li>
                    <li>
                        <span class="font-semibold">এই প্ল্যাটফর্ম ব্যবহারকারীদের জন্য কী আইনি ঝুঁকি রয়েছে?</span>  
                        ব্যবহারকারীদের অবশ্যই নিশ্চিত করতে হবে যে তাদের জমাকৃত তথ্য সত্য। মিথ্যা অভিযোগের ফলে মানহানি মামলাসহ আইনি ব্যবস্থা নেওয়া হতে পারে।
                    </li>
                    <li>
                        <span class="font-semibold">আমি কীভাবে আমার তথ্য এই ওয়েবসাইট থেকে অপসারণ করতে পারি?</span>  
                        ভুল তথ্য প্রমাণ করার জন্য যথাযথ প্রমাণসহ আপিল জমা দেওয়া যেতে পারে। আমাদের টিম পর্যালোচনা করে প্রয়োজনীয় ব্যবস্থা নেবে।
                    </li>
                <ol>
            </div>
        </div>

        <!-- Section 2: English Content (Hidden by Default) -->
        <div id="english-content" style="display: none;" class="bg-white shadow-md p-6 rounded-lg mb-8">
            <div class="container mx-auto px-4 py-8">
                <h2 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide mb-4">
                    Shocheton.org - How This Platform Works
                </h2>
                <p class="text-gray-700 mb-4">
                    <strong>Shocheton.org</strong> is an open digital platform where the public can submit information about sexual offenses or abuse...
                </p>
                <!-- English Steps List -->
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

            <div class="container mx-auto px-4 py-8">
                <h2 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide mb-4">
                    FAQ - FREQUENTLY ASKED QUESTIONS
                </h2>

                <!-- English Questions List -->
                <ol class="list-decimal list-inside space-y-4 text-gray-700">
                    <li> 
                        <span class="font-semibold">How is information verified before being published?</span>  
                        - Each submission undergoes a review process by the moderation team before being posted. However, we encourage users to provide supporting evidence, and we reserve the right to reject submissions lacking credibility.
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
                </ol>
            </div>
        </div>

    </main>

    <script>
        document.getElementById('btn-bangla').addEventListener('click', function() {
            document.getElementById('bangla-content').style.display = 'block';
            document.getElementById('english-content').style.display = 'none';
        });

        document.getElementById('btn-english').addEventListener('click', function() {
            document.getElementById('bangla-content').style.display = 'none';
            document.getElementById('english-content').style.display = 'block';
        });
    </script>
    
@endsection

