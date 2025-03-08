@extends('layouts.user')
@section('page_title','Report an Incident | Bangladesh Sex Offenders Registry')
@section('page_content')

<!-- Outer Container -->
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4 py-6 bg-white shadow-md rounded-lg">

        <!-- Page Heading -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide">
                Report an Incident
            </h1>
            <p class="text-gray-600 mt-2">
                We’re here to help you document your experience and take the next steps.
            </p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-4">
                <strong class="font-bold">There were some problems with your input:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Start -->
        <form id="reportForm" action="{{ route('submit.report') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Progress Indicators -->
            <div class="flex items-center justify-center space-x-4 mb-6">
                <div id="step1-indicator" class="w-8 h-8 flex items-center justify-center rounded-full bg-red-600 text-white font-bold">1</div>
                <div id="step2-indicator" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 text-gray-700 font-bold">2</div>
                <div id="step3-indicator" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 text-gray-700 font-bold">3</div>
                <div id="step4-indicator" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 text-gray-700 font-bold">4</div>
            </div>

            <!-- STEP 1: User Info -->
            <div id="step1" class="bg-white p-6 rounded-lg shadow-inner">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    ধাপ ১: আপনার তথ্য / Step 1: Your Information
                </h2>

                <!-- Report Type -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    প্রতিবেদন ধরন / Report Type:
                </label>
                <select id="report_type" name="report_type" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">
                    <option value="Victim">ভুক্তভোগী (নিজে প্রতিবেদন করছেন) / I am Self-reporting (Victim)</option>
                    <option value="Witness">সাক্ষী / I am a Witness</option>
                    <option value="Friend/Family Member">বন্ধু/পরিবারের সদস্য / I am a Friend/Family Member</option>
                </select>

                <!-- Full Name -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    নাম / Name:
                </label>
                <input 
                    type="text" 
                    name="user_name" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="নাম লিখুন / Enter your full name" 
                    required
                >

                <!-- Gender -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    লিঙ্গ / Gender:
                </label>
                <select name="gender" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">
                    <option value="">Select / নির্বাচন করুন</option>
                    <option value="male">পুরুষ (Male)</option>
                    <option value="female">নারী (Female)</option>
                    <option value="other">অন্যান্য (Other)</option>
                </select>

                <!-- Victim Info (Hidden by Default) -->
                <div id="victimInfoSection" class="hidden mt-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-md font-semibold mb-2 text-gray-800">
                        ভিক্টিমের তথ্য / Victim’s Information (since you are not the victim)
                    </h3>
                    
                    <label class="block mt-2 text-sm font-semibold text-gray-700">
                        ভিক্টিমের নাম / Victim's Full Name:
                    </label>
                    <input 
                        type="text" 
                        name="victim_name" 
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                        placeholder="ভিক্টিমের নাম লিখুন / Enter victim's name"
                    >

                    <label class="block mt-2 text-sm font-semibold text-gray-700">
                        ভিক্টিমের ফোন / Victim's Phone:
                    </label>
                    <input 
                        type="text" 
                        name="victim_phone" 
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                        placeholder="০১XXXXXXXXX / e.g. 01XXXXXXXXX"
                    >

                    <label class="block mt-2 text-sm font-semibold text-gray-700">
                        ভিক্টিমের ইমেইল / Victim's Email:
                    </label>
                    <input 
                        type="email" 
                        name="victim_email" 
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                        placeholder="victim@example.com"
                    >
                </div>

                <!-- Phone -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    আপনার ফোন নম্বর / Your Phone Number:
                </label>
                <input 
                    type="text" 
                    id="phone" 
                    name="user_phone" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="০১XXXXXXXXX / e.g. 01XXXXXXXXX" 
                    required
                >

                <!-- Email -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    আপনার ইমেইল / Your Email Address:
                </label>
                <input 
                    type="email" 
                    name="user_email" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="you@example.com" 
                    required
                >

                <!-- Contact Permission -->
                <p class="mt-4 text-sm font-semibold text-gray-700">
                    আপনি কি আরও যাচাইয়ের জন্য যোগাযোগ করতে চান? / 
                    Do you wish to be contacted for further verification?
                </p>
                <div class="flex space-x-4 mt-2">
                    <label class="text-gray-700">
                        <input type="radio" name="contact_permission" value="1" checked> Yes
                    </label>
                    <label class="text-gray-700">
                        <input type="radio" name="contact_permission" value="0"> No
                    </label>
                </div>

                <!-- Navigation Button for Step 1 -->
                <div class="flex justify-end mt-6">
                    <button 
                        type="button" 
                        onclick="nextStep(1)" 
                        class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-800 transition"
                    >
                        পরবর্তী (NEXT)
                    </button>
                </div>
            </div>

            <!-- STEP 2: Incident Information -->
            <div id="step2" class="bg-white p-6 rounded-lg shadow-inner hidden">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    ধাপ ২: ঘটনার তথ্য / Step 2: Incident Information
                </h2>

                <!-- Incident Type -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    ঘটনার ধরন / Incident Type:
                </label>
                <select name="incident_type" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">
                    <option value="Rape">ধর্ষণ (Rape)</option>
                    <option value="Attempted Rape">ধর্ষণের চেষ্টা (Attempted Rape)</option>
                    <option value="Child Sexual Abuse">শিশুর প্রতি যৌন নির্যাতন (Child Sexual Abuse)</option>
                    <option value="Molestation">শ্লীলতাহানি (Molestation)</option>
                    <option value="Sexual Harassment">যৌন হয়রানি (Sexual Harassment)</option>
                    <option value="Cyber Harassment">সাইবার হয়রানি (Cyber Harassment)</option>
                    <option value="Blackmail">ব্ল্যাকমেইল (Blackmail)</option>
                    <option value="Stalking">অনুসরণ করা (Stalking)</option>
                    <option value="Other">অন্যান্য (Other)</option>
                </select>

                <!-- Date & Time -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    ঘটনার তারিখ / Date of Incident:
                </label>
                <input type="date" name="incident_date" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">

                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    ঘটনার সময় / Time of Incident:
                </label>
                <input type="time" name="incident_time" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">

                <!-- Location -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    ঘটনার স্থান / Location:
                </label>
                <input 
                    type="text" 
                    name="location" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="অবস্থান লিখুন / Enter location"
                >

                <!-- Evidence (Multiple) -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    প্রমাণ (ঐচ্ছিক) / Evidence (optional):
                </label>
                <input 
                    type="file" 
                    name="evidence[]" 
                    multiple 
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400"
                >

                <!-- Detailed Description -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    বিস্তারিত বিবরণ / Detailed Description:
                </label>
                <textarea 
                    name="description" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="ঘটনার বিবরণ দিন / Describe the incident..."
                ></textarea>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-6">
                    <button 
                        type="button" 
                        onclick="prevStep(2)" 
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-400 transition"
                    >
                        পূর্ববর্তী (PREVIOUS)
                    </button>
                    <button 
                        type="button" 
                        onclick="nextStep(2)" 
                        class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-800 transition"
                    >
                        পরবর্তী (NEXT)
                    </button>
                </div>
            </div>

            <!-- STEP 3: Offender & Witness Information -->
            <div id="step3" class="bg-white p-6 rounded-lg shadow-inner hidden">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    ধাপ ৩: অপরাধী ও সাক্ষীর তথ্য / Step 3: Offender & Witness Information
                </h2>

                <!-- Offender Name -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    অপরাধীর নাম / Offender Name:
                </label>
                <input type="text" name="offender_name" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">

                <!-- Offender Gender -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    অপরাধীর লিঙ্গ / Offender Gender:
                </label>
                <select name="offender_gender" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">
                    <option value="male">পুরুষ (Male)</option>
                    <option value="female">নারী (Female)</option>
                    <option value="other">অন্যান্য (Other)</option>
                </select>

                <!-- Offender Age -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    অপরাধীর আনুমানিক বয়স / Offender Age (Approx):
                </label>
                <input type="number" name="offender_age" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">

                <!-- Offender Relation -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    ভিক্টিমের সাথে সম্পর্ক / Relation to Victim:
                </label>
                <select name="offender_relation" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">
                    <option value="Stranger">অপরিচিত (Stranger)</option>
                    <option value="Family Member">পরিবারের সদস্য (Family Member)</option>
                    <option value="Teacher">শিক্ষক (Teacher)</option>
                    <option value="Colleague">সহকর্মী (Colleague)</option>
                    <option value="Neighbor">প্রতিবেশী (Neighbor)</option>
                    <option value="Partner/Spouse">সঙ্গী/স্বামী/স্ত্রী (Partner/Spouse)</option>
                    <option value="Religious Leader">ধর্মীয় নেতা (Religious Leader)</option>
                    <option value="Police/Authority">পুলিশ/কর্তৃপক্ষ (Police/Authority)</option>
                    <option value="Other">অন্যান্য (Other)</option>
                </select>

                <!-- Offender Photo (optional) -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    অপরাধীর ছবি (ঐচ্ছিক) / Offender Photo (optional):
                </label>
                <input 
                    type="file" 
                    name="offender_photo" 
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400"
                >

                <!-- Witness Information (Hide if user is already witness) -->
                <div id="witnessInfoSection" class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-md font-semibold mb-2 text-gray-800">
                        সাক্ষীর তথ্য (যদি থাকে) / Witness Information (if any)
                    </h3>

                    <label class="block mt-2 text-sm font-semibold text-gray-700">
                        সাক্ষীর নাম / Witness Name (Optional):
                    </label>
                    <input type="text" name="witness_name" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">

                    <label class="block mt-2 text-sm font-semibold text-gray-700">
                        সাক্ষীর ফোন / Witness Phone (Optional):
                    </label>
                    <input type="text" name="witness_phone" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">

                    <label class="block mt-2 text-sm font-semibold text-gray-700">
                        সাক্ষীর ইমেইল / Witness Email (Optional):
                    </label>
                    <input type="email" name="witness_email" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-6">
                    <button 
                        type="button" 
                        onclick="prevStep(3)" 
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-400 transition"
                    >
                        পূর্ববর্তী (PREVIOUS)
                    </button>
                    <button 
                        type="button" 
                        onclick="nextStep(3)" 
                        class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-800 transition"
                    >
                        পরবর্তী (NEXT)
                    </button>
                </div>
            </div>

            <!-- STEP 4: Legal Status & Submission -->
            <div id="step4" class="bg-white p-6 rounded-lg shadow-inner hidden">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    ধাপ ৪: আইনি অবস্থা ও জমা / Step 4: Legal Status & Submission
                </h2>

                <!-- Police Status -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    পুলিশকে জানানো হয়েছে? / Was this reported to the police?
                </label>
                <select name="police_status" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">
                    <option value="unreported">অবহিত করা হয়নি (Unreported)</option>
                    <option value="reported">অবহিত করা হয়েছে (Reported)</option>
                    <option value="in-progress">প্রক্রিয়াধীন (In Progress)</option>
                </select>

                <!-- Police Station -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    পুলিশ স্টেশন / Police Station:
                </label>
                <input 
                    type="text" 
                    name="police_station" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="থানার নাম / Name of Police Station"
                >

                <!-- Police Case Number -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    মামলা / জিডি নম্বর / Police Case / GD # (If any):
                </label>
                <input 
                    type="text" 
                    name="police_case_number" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="মামলা বা জিডি নম্বর / Case or GD Number"
                >

                <!-- Legal Support -->
                <p class="mt-4 text-sm font-semibold text-gray-700">
                    আপনি কি আইনি সহায়তা চান? / Do you want legal support?
                </p>
                <div class="flex space-x-4 mt-2">
                    <label class="text-gray-700">
                        <input type="radio" name="legal_support" value="1"> Yes
                    </label>
                    <label class="text-gray-700">
                        <input type="radio" name="legal_support" value="0" checked> No
                    </label>
                </div>

                <!-- NGO Support -->
                <p class="mt-4 text-sm font-semibold text-gray-700">
                    আপনি কি এনজিও সহায়তা চান? / Do you want NGO support?
                </p>
                <div class="flex space-x-4 mt-2">
                    <label class="text-gray-700">
                        <input type="radio" name="ngo_support" value="1"> Yes
                    </label>
                    <label class="text-gray-700">
                        <input type="radio" name="ngo_support" value="0" checked> No
                    </label>
                </div>

                <!-- Privacy Level -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    গোপনীয়তার মাত্রা / Privacy Level:
                </label>
                <select name="privacy_level" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">
                    <option value="private">ব্যক্তিগত (Private)</option>
                    <option value="public">সর্বসাধারণ (Public)</option>
                </select>

                <!-- Victim Photo (optional) -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    ভিক্টিমের ছবি (ঐচ্ছিক) / Victim Photo (optional):
                </label>
                <input 
                    type="file" 
                    name="victim_photo" 
                    class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400"
                >

                <!-- Additional Notes -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    অতিরিক্ত নোট / Additional Notes (Optional):
                </label>
                <textarea 
                    name="additional_notes" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="অতিরিক্ত তথ্য লিখুন / Any extra details..."
                ></textarea>

                <!-- Navigation & Submit -->
                <div class="flex justify-between mt-6">
                    <button 
                        type="button" 
                        onclick="prevStep(4)" 
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-400 transition"
                    >
                        পূর্ববর্তী (PREVIOUS)
                    </button>
                    <button 
                        type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-red-400 transition"
                    >
                        প্রতিবেদন জমা দিন (SUBMIT REPORT)
                    </button>
                </div>
            </div>
        </form>
        <!-- End of Form -->

    </div> <!-- End Container -->
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const reportTypeSelect = document.getElementById('report_type');
    const victimInfoSection = document.getElementById('victimInfoSection');
    const witnessInfoSection = document.getElementById('witnessInfoSection');
    
    // Initial check on page load
    toggleFields(reportTypeSelect.value);

    // Listen for changes in report type
    reportTypeSelect.addEventListener('change', function() {
        toggleFields(this.value);
    });

    function toggleFields(reportType) {
        if (reportType === 'Victim') {
            // If user is the victim
            victimInfoSection.classList.add('hidden');
            witnessInfoSection.classList.remove('hidden');
        } else {
            // If user is witness or friend/family
            victimInfoSection.classList.remove('hidden');
            witnessInfoSection.classList.add('hidden');
        }
    }

    // Step navigation
    window.nextStep = function(step) {
        document.getElementById(`step${step}`).classList.add("hidden");
        document.getElementById(`step${step + 1}`).classList.remove("hidden");
        updateIndicator(step + 1);
    };

    window.prevStep = function(step) {
        document.getElementById(`step${step}`).classList.add("hidden");
        document.getElementById(`step${step - 1}`).classList.remove("hidden");
        updateIndicator(step - 1);
    };

    function updateIndicator(activeStep) {
        for (let i = 1; i <= 4; i++) {
            const indicator = document.getElementById(`step${i}-indicator`);
            indicator.classList.remove("bg-red-600", "text-white");
            indicator.classList.add("bg-gray-300", "text-gray-700");
        }
        const activeIndicator = document.getElementById(`step${activeStep}-indicator`);
        activeIndicator.classList.remove("bg-gray-300", "text-gray-700");
        activeIndicator.classList.add("bg-red-600", "text-white");
    }
});
</script>
@endsection
