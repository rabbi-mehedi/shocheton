@extends('layouts.user')
@section('page_title','Report Chadabaaj (Political Extortionist) | Shocheton.org')
@section('page_content')

<!-- Outer Container -->
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4 py-6 bg-white shadow-md rounded-lg">

        <!-- Page Heading -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide">
                Report a Chadabaaj (Political Extortionist)
            </h1>
            <p class="text-gray-600 mt-2">
                Help us document political extortion incidents to create awareness and accountability. 
                Your security is our priority.
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
        <form id="extortionForm" action="{{ route('extortion.report.submit') }}" method="POST" enctype="multipart/form-data">
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
                    Step 1: Your Information
                </h2>

                <!-- Full Name -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Your Name:
                </label>
                <input 
                    type="text" 
                    name="user_name" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="Enter your full name" 
                    required
                >

                <!-- Phone -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Your Phone Number:
                </label>
                <input 
                    type="text" 
                    id="phone" 
                    name="user_phone" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="e.g. 01XXXXXXXXX" 
                    required
                >

                <!-- Email -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Your Email Address:
                </label>
                <input 
                    type="email" 
                    name="user_email" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="you@example.com" 
                    required
                >

                <!-- Anonymous Reporting Option -->
                <div class="mt-4">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="is_anonymous" 
                            name="is_anonymous" 
                            class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500"
                        >
                        <label for="is_anonymous" class="ml-2 block text-sm text-gray-700">
                            I want to report anonymously (your identity will be kept confidential)
                        </label>
                    </div>
                </div>

                <!-- Contact Permission -->
                <div class="mt-4">
                    <p class="text-sm font-semibold text-gray-700">
                        May we contact you for further details or to offer support?
                    </p>
                    <div class="flex space-x-4 mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="contact_permission" value="1" checked class="h-4 w-4 text-red-600 border-gray-300 focus:ring-red-500">
                            <span class="ml-2">Yes, you may contact me</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="contact_permission" value="0" class="h-4 w-4 text-red-600 border-gray-300 focus:ring-red-500">
                            <span class="ml-2">No, please don't contact me</span>
                        </label>
                    </div>
                </div>

                <!-- Security Note -->
                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <h3 class="font-semibold text-blue-800">Your Safety Matters</h3>
                    <p class="mt-1 text-sm text-blue-700">
                        We prioritize your security and privacy. All personal information is encrypted and protected.
                        If you're concerned about safety, you can report anonymously.
                    </p>
                </div>

                <!-- Navigation Button for Step 1 -->
                <div class="flex justify-end mt-6">
                    <button 
                        type="button" 
                        onclick="nextStep(1)" 
                        class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-800 transition"
                    >
                        Next
                    </button>
                </div>
            </div>

            <!-- STEP 2: Extortionist Information -->
            <div id="step2" class="bg-white p-6 rounded-lg shadow-inner hidden">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    Step 2: Extortionist Information
                </h2>

                <!-- Political Affiliation -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Political Affiliation/Organization: <span class="text-red-600">*</span>
                </label>
                <select name="political_affiliation" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" required>
                    <option value="">Select political affiliation</option>
                    <option value="Awami League">Awami League</option>
                    <option value="BNP">BNP</option>
                    <option value="Chhatra League">Chhatra League</option>
                    <option value="Jubo League">Jubo League</option>
                    <option value="Chhatra Shibir">Chhatra Shibir</option>
                    <option value="Jatiyotabadi Chhatra Dal">Jatiyotabadi Chhatra Dal</option>
                    <option value="Local Political Group">Local Political Group</option>
                    <option value="Other">Other</option>
                </select>

                <!-- Extortionist Name (Optional) -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Extortionist Name (if known):
                </label>
                <input 
                    type="text" 
                    name="extortionist_name" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="Enter name if known (optional)"
                >

                <!-- Position/Role -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Position/Role (if known):
                </label>
                <input 
                    type="text" 
                    name="position" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="E.g., Local Leader, Student Wing Member, etc."
                >

                <!-- Privacy Notice -->
                <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
                    <p class="text-sm text-yellow-800">
                        <strong>Note:</strong> If you don't know the specific individual's name, providing information about 
                        their political affiliation, approximate rank, or role is still helpful.
                    </p>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-6">
                    <button 
                        type="button" 
                        onclick="prevStep(2)" 
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-400 transition"
                    >
                        Previous
                    </button>
                    <button 
                        type="button" 
                        onclick="nextStep(2)" 
                        class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-800 transition"
                    >
                        Next
                    </button>
                </div>
            </div>

            <!-- STEP 3: Business Details -->
            <div id="step3" class="bg-white p-6 rounded-lg shadow-inner hidden">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    Step 3: Business/Organization Details
                </h2>

                <!-- Business Name -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Business/Organization Name: <span class="text-red-600">*</span>
                </label>
                <input 
                    type="text" 
                    name="business_name" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="Enter business or organization name" 
                    required
                >

                <!-- Business Sector -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Business Sector: <span class="text-red-600">*</span>
                </label>
                <select name="business_sector" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" required>
                    <option value="">Select business sector</option>
                    <option value="Retail">Retail</option>
                    <option value="Food & Restaurant">Food & Restaurant</option>
                    <option value="Manufacturing">Manufacturing</option>
                    <option value="Construction">Construction</option>
                    <option value="Transportation">Transportation</option>
                    <option value="Technology">Technology</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Education">Education</option>
                    <option value="Real Estate">Real Estate</option>
                    <option value="Financial Services">Financial Services</option>
                    <option value="Personal Service">Personal Service</option>
                    <option value="Other">Other</option>
                </select>

                <!-- Business Location - District -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    District: <span class="text-red-600">*</span>
                </label>
                <select name="business_address_district" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" required>
                    <option value="">Select district</option>
                    <option value="Dhaka">Dhaka</option>
                    <option value="Chittagong">Chittagong</option>
                    <option value="Khulna">Khulna</option>
                    <option value="Rajshahi">Rajshahi</option>
                    <option value="Sylhet">Sylhet</option>
                    <option value="Barisal">Barisal</option>
                    <option value="Rangpur">Rangpur</option>
                    <option value="Mymensingh">Mymensingh</option>
                    <!-- Add more districts as needed -->
                </select>

                <!-- Business Location - Upazila -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Upazila/Area: <span class="text-red-600">*</span>
                </label>
                <input 
                    type="text" 
                    name="business_address_upazila" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="Enter upazila or area name" 
                    required
                >

                <!-- Detailed Address -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Detailed Address (Optional):
                </label>
                <textarea 
                    name="business_address_detail" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="Provide more specific location details if comfortable sharing"
                    rows="2"
                ></textarea>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-6">
                    <button 
                        type="button" 
                        onclick="prevStep(3)" 
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-400 transition"
                    >
                        Previous
                    </button>
                    <button 
                        type="button" 
                        onclick="nextStep(3)" 
                        class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-800 transition"
                    >
                        Next
                    </button>
                </div>
            </div>

            <!-- STEP 4: Incident Details & Submission -->
            <div id="step4" class="bg-white p-6 rounded-lg shadow-inner hidden">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    Step 4: Incident Details & Submission
                </h2>

                <!-- Date & Time -->
                <div class="flex flex-wrap gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-gray-700">
                            Date of Incident:
                        </label>
                        <input 
                            type="date" 
                            name="incident_date" 
                            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400"
                        >
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-gray-700">
                            Time of Incident:
                        </label>
                        <input 
                            type="time" 
                            name="incident_time" 
                            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400"
                        >
                    </div>
                </div>

                <!-- Demanded Amount -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Demanded Amount (BDT):
                </label>
                <input 
                    type="number" 
                    name="demanded_amount" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="Enter amount (if applicable)"
                >

                <!-- Approach Method -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Method of Approach: <span class="text-red-600">*</span>
                </label>
                <select name="approach_method" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" required>
                    <option value="">How were you approached?</option>
                    <option value="In Person">In Person</option>
                    <option value="Phone Call">Phone Call</option>
                    <option value="SMS">SMS/Text Message</option>
                    <option value="Social Media">Social Media</option>
                    <option value="Through Associates">Through Associates/Intermediaries</option>
                    <option value="Other">Other</option>
                </select>

                <!-- Recurring Demand -->
                <div class="mt-4">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="recurring_demand" 
                            name="recurring_demand" 
                            class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500"
                        >
                        <label for="recurring_demand" class="ml-2 block text-sm text-gray-700">
                            This is a recurring demand (happens repeatedly)
                        </label>
                    </div>
                </div>

                <!-- Description -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Detailed Description of Incident: <span class="text-red-600">*</span>
                </label>
                <textarea 
                    name="threat_description" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="Please provide details of what happened, including threats made, how demands were communicated, etc."
                    rows="4"
                    required
                ></textarea>

                <!-- Evidence Files -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Evidence Files (Optional):
                </label>
                <div class="mt-1 p-4 border border-dashed border-gray-300 rounded-lg bg-gray-50">
                    <input 
                        type="file" 
                        name="evidence[]" 
                        multiple 
                        class="w-full"
                    >
                    <p class="text-xs text-gray-500 mt-2">
                        You can upload photos, audio recordings, screenshots, or documents as evidence.
                        Accepted formats: jpg, png, pdf, mp3, mp4, txt, doc (max 10MB each)
                    </p>
                </div>

                <!-- Police Report Status -->
                <div class="mt-4">
                    <label class="block text-sm font-semibold text-gray-700">
                        Have you reported this to the police?
                    </label>
                    <select name="police_status" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">
                        <option value="unreported">Not reported</option>
                        <option value="reported">Reported</option>
                        <option value="in-progress">In progress</option>
                    </select>
                </div>

                <!-- Police Station -->
                <div id="police_station_container" class="mt-4 hidden">
                    <label class="block text-sm font-semibold text-gray-700">
                        Police Station:
                    </label>
                    <input 
                        type="text" 
                        name="police_station" 
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                        placeholder="Enter police station name"
                    >
                </div>

                <!-- Support Needs -->
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="needs_legal_support" 
                            name="needs_legal_support" 
                            class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500"
                        >
                        <label for="needs_legal_support" class="ml-2 block text-sm text-gray-700">
                            I need legal support
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="needs_ngo_support" 
                            name="needs_ngo_support" 
                            class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500"
                        >
                        <label for="needs_ngo_support" class="ml-2 block text-sm text-gray-700">
                            I need NGO support
                        </label>
                    </div>
                </div>

                <!-- Additional Notes -->
                <label class="block mt-4 text-sm font-semibold text-gray-700">
                    Additional Notes:
                </label>
                <textarea 
                    name="additional_details" 
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" 
                    placeholder="Anything else you'd like to share..."
                    rows="2"
                ></textarea>

                <!-- reCAPTCHA -->
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-gray-700">
                        Please verify you are not a robot:
                    </label>
                    <div class="g-recaptcha" data-sitekey="6LftofgqAAAAAGRy8zFG3z0Mo4eG5wcuTT_Wye4w"></div>
                </div>

                <!-- Navigation & Submit -->
                <div class="flex justify-between mt-6">
                    <button 
                        type="button" 
                        onclick="prevStep(4)" 
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-gray-400 transition"
                    >
                        Previous
                    </button>
                    <button 
                        type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold focus:outline-none focus:ring-2 focus:ring-red-400 transition"
                    >
                        Submit Report
                    </button>
                </div>

                <!-- Final Security Notice -->
                <div class="mt-6 p-4 bg-green-50 rounded-lg">
                    <p class="text-sm text-green-800">
                        <strong>Security Notice:</strong> Your report will be securely stored and reviewed. We take all necessary 
                        precautions to protect your identity and data. Reports will only be shared with authorities with your 
                        permission or as required by law.
                    </p>
                </div>
            </div>
        </form>
        <!-- End of Form -->

    </div> <!-- End Container -->
</div>

<!-- Load the reCAPTCHA API script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Police station visibility toggle based on police status
    const policeStatusSelect = document.querySelector('select[name="police_status"]');
    const policeStationContainer = document.getElementById('police_station_container');
    
    policeStatusSelect.addEventListener('change', function() {
        if (this.value === 'unreported') {
            policeStationContainer.classList.add('hidden');
        } else {
            policeStationContainer.classList.remove('hidden');
        }
    });
    
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