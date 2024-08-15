@extends('layouts.main')
@section('title', 'Verify email - Blox Fruits Calculator')
@section('main_section')

    <div class="min-h-screen-cus flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:size-full before:-z-[1] before:transform before:-translate-x-1/2">
        <div class="w-full sm:max-w-md mt-6 p-8 bg-white shadow-md border-custom overflow-hidden sm:rounded-lg">
            
            <h1 class="text-xl font-bold text-gray-800 mb-2">Thank you for signing up with us 💖</h1>
            <p class="mb-4 text-sm text-gray-600">
                You’re almost there! We sent an email to 
                <span class="font-medium text-gray-800">
                    {{ Auth::user()->email }}
                </span>
            </p>
            <p class="mb-4 text-sm text-gray-600">
                Just click on the link in that email to complete your signup. <br> If you don't see it, you may need to check
                your <span class="font-medium text-gray-800">spam folder</span>.
            </p>
            <p class="mb-4 text-sm text-gray-600">
                Still can't find the email? resend.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <div>
                        <x-primary-button>
                            {{ __('Resend Verification Email') }}
                        </x-primary-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
