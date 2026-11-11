@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto sm:px-6 lg:px-8 mt-10">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">{{ __('Verify Your Email Address') }}</h2>

            @if (session('resent'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ __('A fresh verification link has been sent to your email address.') }}</span>
                </div>
            @endif

            <p class="text-gray-700 mb-4">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
            <p class="text-gray-700 mb-4">{{ __('If you did not receive the email') }},</p>
            
            <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="text-indigo-600 hover:text-indigo-900 underline focus:outline-none">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>
</div>
@endsection
