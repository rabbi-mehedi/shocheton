<div>
    <!-- Alpine.js for toggling mobile menu -->
    <!-- Make sure you have: <script src="//unpkg.com/alpinejs" defer></script> in your layout -->

    <nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
        <!-- Top Bar -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Left: Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('wide_logo.png') }}" alt="Logo" class="h-8 w-auto sm:h-10">
                    </a>
                </div>

                <!-- Right (Desktop) -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-8">
                    <!-- Example nav links -->
                    <a href="{{ route('home') }}" class="text-gray-900 hover:text-gray-600">Home</a>
                    <a href="{{ route('submit.report.form') }}" class="text-gray-900 hover:text-gray-600">Report Offense</a>
                    <a href="{{ route('extortion.report.form') }}" class="text-gray-900 hover:text-gray-600">Report Extortion</a>
                    @auth
                        <!-- Desktop: Profile/Logout Dropdown -->
                        <div class="relative" x-data="{ openUser: false }">
                            <button 
                                @click="openUser = !openUser" 
                                class="flex items-center focus:outline-none text-gray-900 hover:text-gray-600"
                            >
                                <span class="mr-1">
                                    {{ auth()->user()->name ?? 'Profile' }}
                                </span>
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown -->
                            <div 
                                x-show="openUser" 
                                @click.away="openUser = false"
                                class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-md py-2 z-50"
                            >
                                @if (auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" 
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Admin Dashboard
                                </a>
                                @endif
                                <a href="{{ route('profile.edit') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Profile
                                </a>
                                <a href="{{route('emergency.contacts')}}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Emergency Contacts
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    @guest
                        <!-- Desktop: Login Link -->
                        <a href="{{ route('login') }}" class="text-gray-900 hover:text-gray-600">
                            Login
                        </a>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button
                        @click="open = !open"
                        type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100"
                    >
                        <!-- Hamburger Icon -->
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{'hidden': open, 'inline-flex': !open}"
                                class="inline-flex"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{'hidden': !open, 'inline-flex': open}"
                                class="hidden"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="sm:hidden" x-show="open" @click.away="open = false">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">
                    Home
                </a>
                <a href="{{ route('submit.report.form') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">
                    Report Offense
                </a>
                <a href="{{ route('extortion.report.form') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">
                    Report Extortion
                </a>

                @auth
                    <!-- Mobile: Profile & Logout -->
                    <div class="border-t border-gray-200 pt-2">
                        <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">
                            Profile
                        </a>
                        <a href="{{route('emergency.contacts')}}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">
                            Emergency Contacts
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="w-full text-left block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth

                @guest
                    <!-- Mobile: Login Link -->
                    <div class="border-t border-gray-200 pt-2">
                        <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-100">
                            Login
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
</div>
