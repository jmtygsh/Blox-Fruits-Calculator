@extends('layouts.main')
@section('title', 'Forgot Password - Blox Fruits Calculator')
@section('main_section')
    <div class="min-h-screen-cus flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative mb-24 overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:size-full before:-z-[1] before:transform before:-translate-x-1/2">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md border-custom overflow-hidden sm:rounded-lg">


            <h1 class="block text-2xl font-bold text-gray-800 text-center mb-2">Reset password</h1>
            <p class="mb-4 text-sm text-gray-500 text-center">
                Forgot your password? No problem. <br> Just let us know your email address and we will email you a password reset link.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" class="text-center" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection
