@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative bg-white overflow-hidden shadow-sm">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-10 sm:pt-16 lg:pt-20">
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 lg:mt-16 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left animate-fade-in-up">
                    <span class="text-sm font-semibold uppercase tracking-wider text-brand-accent mb-2 block">New Arrivals Available</span>
                    <h1 class="text-4xl tracking-tight font-extrabold text-brand-dark sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Upgrade your life with</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-brand-purple to-brand-blue">GSM Galaxy</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Discover the latest flagship smartphones, unbeatable deals, and premium accessories. Experience technology at your fingertips.
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-brand-blue hover:bg-brand-purple transition duration-300 md:py-4 md:text-lg md:px-10 no-underline">
                                Shop Now
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-brand-blue bg-brand-light hover:bg-gray-200 transition duration-300 md:py-4 md:text-lg md:px-10 no-underline">
                                View Deals
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-gradient-to-b from-brand-light to-white flex items-center justify-center p-8">
        <img class="h-64 sm:h-80 md:h-96 lg:h-full lg:max-h-[600px] object-contain drop-shadow-2xl animate-fade-in-up" src="{{ asset('images/hero_phone.jpg') }}" alt="Flagship Smartphone">
    </div>
</div>

<!-- Featured Products -->
<div class="bg-gray-50 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-base font-semibold text-brand-purple tracking-wide uppercase">Top Sellers</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Featured Smartphones
            </p>
        </div>

        <div class="mt-12 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @for ($i = 1; $i <= 3; $i++)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 group cursor-pointer border border-gray-100">
                <div class="h-64 bg-gray-100 flex items-center justify-center p-6 relative overflow-hidden">
                    <span class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full z-10">SALE</span>
                    <img src="{{ asset('images/hero_phone.jpg') }}" alt="Phone" class="h-48 w-auto object-contain group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900">Galaxy X Pro</h3>
                    <div class="flex items-center mt-2">
                        <span class="text-yellow-400 text-sm">★★★★★</span>
                        <span class="text-gray-500 text-sm ml-2">(128 reviews)</span>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-2xl font-extrabold text-brand-dark">$899</span>
                        <button class="bg-brand-blue text-white p-3 rounded-full hover:bg-brand-purple transition shadow-md hover:shadow-lg">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
@endsection
