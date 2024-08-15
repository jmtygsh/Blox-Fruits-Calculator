@extends('layouts.main')
@section('title', 'Confirm Password - Blox Fruits Calculator')
@section('main_section')
    <div
        class="min-h-screen-cus flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative mb-24 overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:size-full before:-z-[1] before:transform before:-translate-x-1/2">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md border-custom overflow-hidden sm:rounded-lg">

            
            <div class="mb-4 text-sm text-gray-600">
               'This is a secure area of the application. Please confirm your password before continuing.
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-4">
                    <x-primary-button>
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection
