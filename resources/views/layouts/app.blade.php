<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'GSM Galaxy') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700|inter:400,500,600" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-brand-dark font-sans antialiased flex flex-col min-h-screen">
    <div id="app" class="flex-grow flex flex-col">
        <!-- Top Navigation -->
        <nav x-data="{ open: false }" class="bg-gradient-to-r from-brand-purple to-brand-blue shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex items-center gap-2 text-2xl font-bold text-white no-underline tracking-tight hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            {{ config('app.name', 'GSM Galaxy') }}
                        </a>
                    </div>
                    
                    <!-- Search Bar (Hidden on Mobile) -->
                    <div class="hidden md:flex flex-1 max-w-lg mx-8">
                        <div class="relative w-full">
                            <input type="text" placeholder="Search for phones, accessories..." class="w-full pl-4 pr-10 py-2 rounded-full border-none focus:ring-2 focus:ring-brand-accent text-sm text-gray-800 shadow-inner">
                            <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-400 hover:text-brand-purple">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center">
                        <a href="{{ route('contact.index') }}" class="text-white hover:text-gray-200 ml-4 p-2 relative no-underline font-medium">Contact</a>
                        <a href="#" class="text-white hover:text-gray-200 ml-4 p-2 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-brand-purple bg-white rounded-full">0</span>
                        </a>

                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="text-sm font-medium text-white hover:text-gray-200 ml-6 no-underline">{{ __('Login') }}</a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 px-4 py-2 bg-white text-brand-blue text-sm font-semibold rounded-md shadow hover:bg-gray-100 transition duration-150 no-underline">{{ __('Sign Up') }}</a>
                            @endif
                        @else
                            <div class="ml-6 relative" x-data="{ dropdownOpen: false }" @click.away="dropdownOpen = false">
                                <div>
                                    <button @click="dropdownOpen = !dropdownOpen" type="button" class="flex items-center text-sm font-medium text-white hover:text-gray-200 focus:outline-none transition duration-150">
                                        {{ Auth::user()->name }}
                                        <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                                <div x-show="dropdownOpen" x-transition class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-xl py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" style="display: none;">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 no-underline">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = !open" type="button" class="text-white hover:text-gray-200 p-2 focus:outline-none">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-brand-blue">
                <div class="px-4 pt-2 pb-4 space-y-1">
                    <input type="text" placeholder="Search..." class="w-full px-3 py-2 rounded-md border-none mb-2 text-sm text-gray-800">
                    <a href="{{ route('contact.index') }}" class="block px-3 py-2 text-base font-medium text-white hover:bg-brand-purple rounded-md no-underline">Contact</a>
                    <a href="#" class="block px-3 py-2 text-base font-medium text-white hover:bg-brand-purple rounded-md no-underline">Cart (0)</a>
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-white hover:bg-brand-purple rounded-md no-underline">{{ __('Login') }}</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium text-white hover:bg-brand-purple rounded-md no-underline">{{ __('Register') }}</a>
                        @endif
                    @else
                        <div class="mt-4 pt-4 border-t border-brand-purple">
                            <div class="px-3">
                                <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                            </div>
                            <div class="mt-2 space-y-1">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-3 py-2 text-base font-medium text-white hover:bg-brand-purple rounded-md no-underline">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="flex-grow">
            @yield('content')
        </main>

        <footer class="bg-brand-dark text-gray-300 py-10 text-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold text-white mb-4">GSM Galaxy</h3>
                    <p class="text-gray-400">Your ultimate destination for the latest smartphones and accessories. Quality and price guaranteed.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 uppercase tracking-wider">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition no-underline">Shop Phones</a></li>
                        <li><a href="#" class="hover:text-white transition no-underline">Accessories</a></li>
                        <li><a href="#" class="hover:text-white transition no-underline">Support</a></li>
                        <li><a href="{{ route('contact.index') }}" class="hover:text-white transition no-underline">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 uppercase tracking-wider">Newsletter</h4>
                    <p class="text-gray-400 mb-2">Subscribe to get special offers and updates.</p>
                    <div class="flex">
                        <input type="email" placeholder="Email address" class="px-3 py-2 w-full rounded-l-md border-none text-gray-900 focus:ring-brand-accent">
                        <button class="bg-brand-accent text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition">Subscribe</button>
                    </div>
                </div>
            </div>
            <div class="mt-10 border-t border-gray-700 pt-6 text-center text-gray-500">
                &copy; {{ date('Y') }} GSM Galaxy. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>
