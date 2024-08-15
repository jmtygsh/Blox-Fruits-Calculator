@extends('layouts.main')
@section('title', 'Blox Fruits Calculator - Updated on August 15, 2024')
@section('description', 'Discover the power of our Blox Fruits calculator! Easily compare the value of your trading inventory in Blox Fruits and make the most out of your in-game.')
@section('main_section')
    <main>
        <div class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:size-full before:-z-[1] before:transform before:-translate-x-1/2" >
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 md:py-24 py-8">

                <!-- Title -->
                <div class="mt-5 max-w-2xl text-center mx-auto">
                    <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl ">
                        Blox Fruits 
                        <span
                            class="bg-clip-text bg-gradient-to-tl from-blue-600 to-violet-600 text-transparent">Calculator</span>
                    </h1>
                </div>
                <!-- End Title -->

                <div class="mt-5 max-w-3xl text-center mx-auto">
                    <p class="text-lg text-gray-600">
                        Discover the power of our Blox Fruits calculator! Easily compare the value of your trading inventory
                        in Blox Fruits and make the most out of your in-game assets.</p>
                </div>

                <!-- Buttons -->
                <div class="mt-8 gap-3 flex justify-center">
                    <a class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-tl from-blue-600 to-violet-600 hover:from-violet-600 hover:to-blue-600 border border-transparent text-white text-sm font-medium rounded-md focus:outline-none focus:ring-1 focus:ring-gray-600 py-3 px-4"
                        href="{{ url('/calculator') }}">
                        Get started
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                    <a class="fruit-values" href="{{route('dashboard')}}">
                        <span class="fruit-values__icon-wrapper">
                            <svg width="10" class="fruit-values__icon-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 15">
                                <path fill="currentColor" d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"></path>
                            </svg>
                            
                            <svg class="fruit-values__icon-svg  fruit-values__icon-svg--copy" xmlns="http://www.w3.org/2000/svg" width="10" fill="none" viewBox="0 0 14 15">
                                <path fill="currentColor" d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"></path>
                            </svg>
                        </span>
                        Explore All
                    </a>
                </div>
                <!-- End Buttons -->
            </div>
        </div>
        <div>
            <x-features/>
            <x-blog/>
        </div>
    </main>
@endsection
