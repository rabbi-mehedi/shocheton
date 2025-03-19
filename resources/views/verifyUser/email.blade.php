@extends('layouts.user')
@section('page_title','Verification Email Sent! | Bangladesh Sex Offenders Registry')
@section('page_content')
   <div class="container mx-auto px-4 py-8">
       <!-- Language Switcher inside container -->
       <div class="flex justify-end mb-4">
           <button id="btnEnglish" class="w-auto bg-red-600 hover:bg-red-700 text-white px-4 py-2 focus:outline-none transition-colors duration-200">
               English
           </button>
           <button id="btnBangla" class="w-auto bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 ml-2 focus:outline-none transition-colors duration-200">
               বাংলা
           </button>
       </div>
       
       <div class="bg-white rounded shadow p-6 text-center">
           <h1 id="titleText" class="text-2xl font-bold mb-4">
               Verification Email Sent!
           </h1>
           <p id="messageText" class="text-gray-700 mb-6">
               A verification link has been sent to <span class="font-semibold">{{$user->email}}</span>. 
               Please check your email and follow the instructions to verify your account.
           </p>
           <a id="homeButton" href="{{ route('home') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded shadow transition-colors duration-200">
               Go Back to Home
           </a>
       </div>
   </div>
   
   <script>
       const translations = {
           english: {
               title: "Verification Email Sent!",
               message: `A verification link has been sent to <span class="font-semibold">{{$user->email}}</span>. Please check your email and follow the instructions to verify your account.`,
               button: "Go Back to Home"
           },
           bangla: {
               title: "যাচাইকরণ ইমেল পাঠানো হয়েছে!",
               message: `একটি যাচাইকরণ লিঙ্ক <span class="font-semibold">{{$user->email}}</span> এ পাঠানো হয়েছে। অনুগ্রহ করে আপনার ইমেল চেক করুন এবং আপনার অ্যাকাউন্ট যাচাই করতে নির্দেশনা অনুসরণ করুন।`,
               button: "হোমে ফিরে যান"
           }
       };

       const btnEnglish = document.getElementById('btnEnglish');
       const btnBangla = document.getElementById('btnBangla');
       const titleText = document.getElementById('titleText');
       const messageText = document.getElementById('messageText');
       const homeButton = document.getElementById('homeButton');

       btnEnglish.addEventListener('click', function() {
           titleText.innerHTML = translations.english.title;
           messageText.innerHTML = translations.english.message;
           homeButton.innerHTML = translations.english.button;
           
           // Explicitly reset classes for active/inactive state
           btnEnglish.className = "w-auto bg-red-600 hover:bg-red-700 text-white px-4 py-2 focus:outline-none transition-colors duration-200";
           btnBangla.className = "w-auto bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 ml-2 focus:outline-none transition-colors duration-200";
       });

       btnBangla.addEventListener('click', function() {
           titleText.innerHTML = translations.bangla.title;
           messageText.innerHTML = translations.bangla.message;
           homeButton.innerHTML = translations.bangla.button;
           
           // Explicitly reset classes for active/inactive state
           btnBangla.className = "w-auto bg-red-600 hover:bg-red-700 text-white px-4 py-2 ml-2 focus:outline-none transition-colors duration-200";
           btnEnglish.className = "w-auto bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 focus:outline-none transition-colors duration-200";
       });
   </script>
@endsection
