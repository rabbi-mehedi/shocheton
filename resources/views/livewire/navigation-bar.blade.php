<div>
    <!-- Alpine.js is used for toggling the mobile menu and user dropdown -->
    <!-- TailwindCSS classes for styling -->

    <nav x-data="{ openMobile: false, openUserMenu: false }" class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Left: Logo -->
                <div class="flex items-center">
                    <a href="{{route('home')}}">
                        <img src="{{ asset('wide_logo.png') }}" alt="Logo" class="h-8 w-auto sm:h-10">
                    </a>
                </div>

                <!-- Right Section -->
                <div class="hidden sm:flex sm:items-center space-x-8">
                    <!-- Example Admin Links (Desktop) -->
                    <a href="{{route('admin.dashboard')}}" class="text-gray-900 hover:text-gray-600">Dashboard</a>
              

                    <!-- User Dropdown (Desktop) -->
                    <div class="relative" x-data="{ openUserMenu: false }">
                        <button 
                            @click="openUserMenu = !openUserMenu" 
                            class="flex items-center focus:outline-none text-gray-900 hover:text-gray-600"
                        >
                            <span class="mr-1">
                                {{ auth()->user()->name ?? 'Admin' }}
                            </span>
                            <!-- Down Arrow Icon -->
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" 
                                 viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div 
                            x-show="openUserMenu" 
                            @click.away="openUserMenu = false"
                            class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-md py-2 z-50"
                        >
                            <!-- Profile Link -->
                            <a href="#" 
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profile
                            </a>

                            <!-- Logout Link (POST) -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button
                        @click="openMobile = !openMobile"
                        type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100"
                    >
                        <!-- Hamburger Icon -->
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{'hidden': openMobile, 'inline-flex': !openMobile}"
                                class="inline-flex"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{'hidden': !openMobile, 'inline-flex': openMobile}"
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
        <div class="sm:hidden" x-show="openMobile" @click.away="openMobile = false">
            <div class="pt-2 pb-3 space-y-1 border-t border-gray-200">
                <!-- Admin Links (Mobile) -->
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    Dashboard
                </a>
              

                <!-- Profile & Logout (Mobile) -->
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-200">
                    @csrf
                    <button type="submit" 
                            class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
</div>
