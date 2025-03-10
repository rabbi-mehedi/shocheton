<x-guest-layout>
    <!-- Heading & Note -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-extrabold text-gray-800 uppercase tracking-wide">
            Login
        </h1>
        <p class="text-sm text-gray-600 mt-2">
            <!-- Bangla -->
            <span class="block mb-2">
                একটি প্রতিবেদন দাখিল করলে আপনার অ্যাকাউন্ট স্বয়ংক্রিয়ভাবে তৈরি করা হবে।
            </span>
            <!-- English -->
            <span class="block mt-2">
                Once you file a report, your account will be automatically created.
            </span>
        </p>
        
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-white p-6 rounded shadow-md max-w-md mx-auto">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-red-400"
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input 
                id="password" 
                class="block mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-red-400"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center text-gray-700">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-400" 
                    name="remember"
                >
                <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Forgot Password & Login Button -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a 
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400 mr-3"
                    href="{{ route('password.request') }}"
                >
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button 
                type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-red-400"
            >
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
