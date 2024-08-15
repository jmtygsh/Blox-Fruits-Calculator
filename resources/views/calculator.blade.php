@extends('layouts.main')
@section('title', 'Calculator - Blox Fruits Calculator 2024')
@section('description', 'Discover the power of our Blox Fruits calculator to effortlessly compare values, calculate fair trades, and determine potential profit or loss with ease!')
@section('main_section')
    <div
        class="relative overflow-hidden  before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:size-full before:-z-[1] before:transform before:-translate-x-1/2">

        <div class="max-w-6xl px-4 py-10 mx-auto">
            <h1 class="block text-2xl font-bold text-gray-600 text-center mb-3">Blox Fruits Calculator</h1>
            <p class="text-center mb-8 text-gray-600">Select the items you have and the items that you want to calculate &
                find the profit or loss values.</p>
            <!--preview cards-->
            <div class="flex flex-col justify-center items-center">
                <div class="grid  md:grid-cols-2 lg:grid-cols-2 gap-6 ">
                    <!--Left card-->
                    <div class="flex flex-col items-center">
                        <h3 class="text-center mb-4 text-[#8a8a8a] font-extrabold">Has</h3>
                        <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                            @php
                                $minBoxes = 2;
                                $leftCount = count($leftdata);
                            @endphp
                            @foreach ($leftdata as $left)
                                <div
                                    class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-green-100 flex flex-col items-center justify-center relative">
                                    <img src="{{ asset('storage/' . $left->image) }}" alt="{{ $left->image_name }}"
                                        width="80" class="rounded mb-2">
                                    <p class="text-lg font-semibold">{{ $left->name }}</p>

                                    <p class="text-gray-600">
                                        <span>
                                            @if ($left->isPermanent == 1)
                                                ${{ number_format($left->p_value) }}
                                            @else
                                                ${{ number_format($left->value) }}
                                            @endif
                                        </span>
                                    </p>

                                    <p class="text-gray-600 text-sm">
                                        @if ($left->isPermanent)
                                            <span>Permanent value</span>
                                        @else
                                            <span>Normal Value</span>
                                        @endif
                                    </p>

                                    <form action="{{ route('delete-left-item', $left->id) }}" method="POST"
                                        class="absolute top-2 right-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <svg width="20" height="20" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="10" stroke="black" stroke-width="2"
                                                    fill="none" />
                                                <line x1="8" y1="8" x2="16" y2="16"
                                                    stroke="black" stroke-width="2" />
                                                <line x1="8" y1="16" x2="16" y2="8"
                                                    stroke="black" stroke-width="2" />
                                            </svg>

                                        </button>
                                    </form>
                                </div>
                            @endforeach
                            @for ($i = $leftCount; $i < $minBoxes; $i++)
                                <div
                                    class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-[#f0f8ff] flex flex-col items-center justify-center">
                                    <img src="{{ asset('storage/images/demo.svg') }}" alt="Demo Image" width="80"
                                        class="rounded mb-2">
                                    <p class="text-lg font-semibold text-center">Placeholder</p>
                                    <p class="text-gray-600 text-center">$0.00</p>
                                    <p class="text-gray-600 text-sm text-center">Demo Value</p>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <!--end Left card-->

                    <!--Right card-->
                    <div class="flex flex-col items-center">
                        <h3 class="text-center mb-4 text-[#8a8a8a] font-extrabold">Wants</h3>
                        <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                            @php
                                $rightCount = count($rightdata);
                            @endphp
                            @foreach ($rightdata as $right)
                                <div
                                    class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-red-100 flex flex-col items-center justify-center relative">
                                    <img src="{{ asset('storage/' . $right->image) }}" alt="{{ $right->image_name }}"
                                        width="80" class="rounded mb-2">
                                    <p class="text-lg font-semibold">{{ $right->name }}</p>
                                    <p class="text-gray-600">
                                        <span>
                                            @if ($right->isPermanent == 1)
                                                ${{ number_format($right->p_value) }}
                                            @else
                                                ${{ number_format($right->value) }}
                                            @endif
                                        </span>
                                    </p>
                                    <p class="text-gray-600 text-sm">
                                        @if ($right->isPermanent)
                                            <span>Permanent value</span>
                                        @else
                                            <span>Normal Value</span>
                                        @endif
                                    </p>
                                    <form action="{{ route('delete-right-item', $right->id) }}" method="POST"
                                        class="absolute top-2 right-2">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <svg width="20" height="20" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="10" stroke="black" stroke-width="2"
                                                    fill="none" />
                                                <line x1="8" y1="8" x2="16" y2="16"
                                                    stroke="black" stroke-width="2" />
                                                <line x1="8" y1="16" x2="16" y2="8"
                                                    stroke="black" stroke-width="2" />
                                            </svg>

                                        </button>
                                    </form>
                                </div>
                            @endforeach
                            @for ($i = $rightCount; $i < $minBoxes; $i++)
                                <div
                                    class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-[#f0f8ff] flex flex-col items-center justify-center">
                                    <img src="{{ asset('storage/images/demo.svg') }}" alt="Demo Image" width="80"
                                        class="rounded mb-2">
                                    <p class="text-lg font-semibold text-center">Placeholder</p>
                                    <p class="text-gray-600 text-center">$0.00</p>
                                    <p class="text-gray-600 text-sm text-center">Demo Value</p>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <!--End Right card-->
                </div>
            </div>
            <!--End preview cards-->


            <!-- compare result-->
            <div class="flex justify-center">
                @php
                    // Initialize totals
                    $totalValueLeft = 0;
                    $totalPriceLeft = 0;
                    $totalValueRight = 0;
                    $totalPriceRight = 0;

                    // Calculate total value and total price for left data
                    foreach ($leftdata as $left) {
                        if ($left->isPermanent == 0) {
                            $totalValueLeft += $left->value;
                        } else {
                            $totalValueLeft += $left->p_value;
                        }
                        $totalPriceLeft += $left->price; // Always add the price
                    }

                    // Calculate total value and total price for right data
                    foreach ($rightdata as $right) {
                        if ($right->isPermanent == 0) {
                            $totalValueRight += $right->value;
                        } else {
                            $totalValueRight += $right->p_value;
                        }
                        $totalPriceRight += $right->price; // Always add the price
                    }

                    // Format the numbers with commas
                    $formattedTotalValueLeft = number_format($totalValueLeft);
                    $formattedTotalPriceLeft = number_format($totalPriceLeft);
                    $formattedTotalValueRight = number_format($totalValueRight);
                    $formattedTotalPriceRight = number_format($totalPriceRight);

                    // Calculate the total value and price differences
                    $valueDifference = $totalValueLeft - $totalValueRight;

                    // Determine profit or loss
                    $profitOrLossValue = $valueDifference >= 0 ? 'Profit' : 'Loss';

                    $has = $valueDifference >= 0 ? 'High' : 'Lower';

                @endphp
                <!-- Display Profit or Loss -->
                <div class="w-[40rem] border border-gray-300 rounded-md p-4 mt-5 text-center shadow-md">
                    <h3 class="text-lg font-bold">Comparison Result:</h3>
                    <p class="font-medium">Value Difference: <span
                            class="text-blue-700">${{ number_format(abs($valueDifference)) }}
                            ({{ $profitOrLossValue }})
                        </span></p>
                    <p class="text-sm text-gray-600">Due to has being {{ $has }}.</p>
                </div>
            </div>
            <!-- end compare result-->


            <!--result section-->
            <div class="mt-5 flex justify-center">
                <div class="w-[40rem] flex justify-center text-center">
                    <div class="w-full grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-5 ">
                        <!-- First Grid -->
                        <div class="grid grid-cols-2 w-full border border-gray-300 rounded-md bg-green-100  shadow-md ">
                            <div
                                class="px-4 py-2 border border-gray-300 bg-gray-100 text-customGray font-extrabold text-center">
                                Has</div>
                            <div
                                class="px-4 py-2 border border-gray-300 bg-gray-100 text-customGray font-extrabold text-center">
                                Number</div>

                            <div class="px-4 py-2 border border-gray-300 text-center font-medium">Value</div>
                            <div class="px-4 py-2 border border-gray-300 text-center">
                                $<span id="has-value-left" class="font-medium">{{ $formattedTotalValueLeft }}</span>
                            </div>

                            <div class="px-4 py-2 border border-gray-300 text-center font-medium">Price</div>
                            <div class="px-4 py-2 border border-gray-300 text-center">
                                $<span id="want-price-left" class=" font-medium">{{ $formattedTotalPriceLeft }}</span>
                            </div>
                        </div>

                        <!-- Second Grid -->
                        <div class="grid grid-cols-2 w-full border border-gray-300 rounded-md bg-red-100  shadow-md ">
                            <div
                                class="px-4 py-2 border border-gray-300 bg-gray-100 text-customGray font-extrabold text-center">
                                Want</div>
                            <div
                                class="px-4 py-2 border border-gray-300 bg-gray-100 text-customGray font-extrabold text-center">
                                Number</div>

                            <div class="px-4 py-2 border border-gray-300 text-center font-medium">Value</div>
                            <div class="px-4 py-2 border border-gray-300 text-center">
                                $<span id="has-value-right" class="font-medium">{{ $formattedTotalValueRight }}</span>
                            </div>

                            <div class="px-4 py-2 border border-gray-300 text-center font-medium">Price</div>
                            <div class="px-4 py-2 border border-gray-300 text-center">
                                $<span id="want-price-right" class="font-medium">{{ $formattedTotalPriceRight }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end result section-->


            <!--popup-->
            <div class="mt-5 flex justify-center">
                <div class="flex justify-center">
                    <button type="button" id="popup_blink"
                        class="w-64 h-12 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border shadow-md border-transparent bg-white border-custom text-white hover:bg-blue-100 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-overlay="#hs-bg-cards">
                        <svg fill="#000000" width="30" height="30" viewBox="0 0 24 24" id="plus"
                            data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color">
                            <path id="primary" d="M5,12H19M12,5V19"
                                style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                            </path>
                        </svg>
                    </button>
                </div>

                <div id="hs-bg-cards"
                    class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
                    <div
                        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-4xl sm:w-full m-3 h-[calc(100%-3.5rem)] sm:mx-auto">
                        <div
                            class="max-h-full overflow-hidden flex flex-col bg-black shadow-sm rounded-xl pointer-events-auto">
                            <div class="flex justify-between items-center py-3 px-4 border-b-cus">

                                <form action="" class="flex items-center">
                                    <div class="form-control">
                                        <button class="shadow__btn" type="submit" id="search_f">
                                            Search
                                        </button>
                                    </div>
                                    <div class="form-control">
                                        <input class="input input-alt" placeholder="type something here..."
                                            type="search" name="search" id="search" value="{{ $search }}">
                                        <span class="input-border input-border-alt"></span>
                                    </div>
                                </form>

                                <button type="button"
                                    class="flex text-white justify-center items-center size-7 text-sm font-semibold rounded-lg  border-transparent  hover:text-red-300 disabled:opacity-50 disabled:pointer-events-none"
                                    data-hs-overlay="#hs-bg-cards">
                                    <span class="sr-only">Close</span>
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18" />
                                        <path d="m6 6 12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="p-4 overflow-y-auto">
                                <div class="sm:divide-y divide-gray-200">
                                    <div class="py-3 sm:py-6">
                                        <div class="grid gap-2 sm:grid-cols-2 md:grid-cols-2">
                                            <!---card-->
                                            @if ($noResults)
                                                <p class="text-red-500">No results found for "<span
                                                        class="font-bold">{{ $search }}</span>".
                                                </p>
                                            @else
                                                @foreach ($imageDatas as $index => $imageData)
                                                    <div class="bg-blue-100 p-4 transition duration-300 rounded-lg card">
                                                        <div
                                                            class="flex justify-between items-center p-4 border rounded-lg">
                                                            <!-- Image section -->
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ asset('storage/' . $imageData->image) }}"
                                                                    alt="{{ $imageData->image_name }}" width="80"
                                                                    class="rounded">
                                                            </div>

                                                            <!-- Text section -->
                                                            <div class="flex-grow mx-6">
                                                                <h3 class="text-black font-bold">
                                                                    {{ $imageData->image_name }}
                                                                </h3>
                                                                <div class="flex flex-col">
                                                                    <div class="flex items-center border">
                                                                        <div class="check mt-1 mr-2">

                                                                            <input id="check-{{ $index }}"
                                                                                type="checkbox" name="isPermanent"
                                                                                value="1"
                                                                                onclick="toggleValue({{ $index }})"
                                                                                @if ($imageData->isPermanent) checked @endif>
                                                                            <label
                                                                                for="check-{{ $index }}"></label>

                                                                        </div>
                                                                        <div>


                                                                            <div id="normal-value-{{ $index }}"
                                                                                class="{{ $imageData->isPermanent ? 'hidden' : '' }}">
                                                                                $<span
                                                                                    id="number-value-{{ $index }}"></span>
                                                                            </div>


                                                                            <div id="permanent-value-{{ $index }}"
                                                                                class="{{ $imageData->isPermanent ? '' : 'hidden' }}">
                                                                                $<span
                                                                                    id="number-p_value-{{ $index }}"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="normal-number-{{ $index }}"
                                                                        class="{{ $imageData->isPermanent ? 'hidden' : '' }}">

                                                                        Normal Value

                                                                    </div>
                                                                    <div id="permanent-number-{{ $index }}"
                                                                        class="{{ $imageData->isPermanent ? '' : 'hidden' }}">
                                                                        Permanent Value


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Button section -->
                                                        <div class="flex justify-center gap-4">
                                                            <form method="POST" class="hasForm"
                                                                action="{{ route('left-card-select') }}">
                                                                @csrf

                                                                <input type="hidden" name="id"
                                                                    value="{{ $imageData->image_id }}">

                                                                <input type="hidden" name="image"
                                                                    value="{{ $imageData->image }}">

                                                                <input type="hidden" name="name"
                                                                    value="{{ $imageData->image_name }}">

                                                                <input type="hidden" name="normalValue"
                                                                    value="{{ $imageData->image_value }}">

                                                                <input type="hidden" name="permanentValue"
                                                                    value="{{ $imageData->image_p_value }}">

                                                                <input type="hidden" name="price"
                                                                    value="{{ $imageData->price }}">

                                                                <input type="hidden" name="isPermanent"
                                                                    id="isPermanent-l-{{ $index }}"
                                                                    value="0">



                                                                <button type="submit" 
                                                                    class="hasFormSubmit flex items-center justify-center px-4 py-1 border-2 border-gray-800 text-gray-800 font-bold rounded-lg transition duration-300 hover:bg-teal-100 hover:text-teal-800 transform hover:-translate-y-1 active:scale-95"
                                                                    title="Add New has">
                                                                    <span>Add Has</span>
                                                                    <svg class="ml-2 w-5 h-5 stroke-current"
                                                                        viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-width="1.5"
                                                                            d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z">
                                                                        </path>
                                                                        <path stroke-width="1.5" stroke="white"
                                                                            d="M8 12H16">
                                                                        </path>
                                                                        <path stroke-width="1.5" stroke="white"
                                                                            d="M12 16V8">
                                                                        </path>
                                                                    </svg>
                                                                </button>
                                                            </form>

                                                            <form method="POST" class="wantForm"
                                                                action="{{ route('right-card-select') }}">

                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $imageData->image_id }}">
                                                                <input type="hidden" name="image"
                                                                    value="{{ $imageData->image }}">

                                                                <input type="hidden" name="name"
                                                                    value="{{ $imageData->image_name }}">
                                                                <input type="hidden" name="normalValue"
                                                                    value="{{ $imageData->image_value }}">
                                                                <input type="hidden" name="permanentValue"
                                                                    value="{{ $imageData->image_p_value }}">
                                                                <input type="hidden" name="price"
                                                                    value="{{ $imageData->price }}">
                                                                <input type="hidden" name="isPermanent"
                                                                    id="isPermanent-r-{{ $index }}"
                                                                    value="0">
                                                                <button type="submit"
                                                                    class="wantFormSubmit flex items-center justify-center px-4 py-1 border-2 border-gray-800 text-gray-800 font-bold rounded-lg transition duration-300 hover:bg-teal-100 hover:text-teal-800 transform hover:-translate-y-1 active:scale-95"
                                                                    title="Add New Want">
                                                                    <span>Add Want</span>
                                                                    <svg class="ml-2 w-5 h-5 stroke-current"
                                                                        viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-width="1.5"
                                                                            d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z">
                                                                        </path>
                                                                        <path stroke-width="1.5" stroke="white"
                                                                            d="M8 12H16">
                                                                        </path>
                                                                        <path stroke-width="1.5" stroke="white"
                                                                            d="M12 16V8">
                                                                        </path>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <!-- End Button section -->

                                                    </div>
                                                @endforeach
                                            @endif
                                            <script>
                                                function toggleValue(index) {
                                                    let checkBox = document.getElementById('check-' + index);
                                                    let normalValue = document.getElementById('normal-value-' + index);
                                                    let permanentValue = document.getElementById('permanent-value-' + index);
                                                    let normalNumber = document.getElementById('normal-number-' + index);
                                                    let permanentNumber = document.getElementById('permanent-number-' + index);
                                                    let hiddenInputL = document.getElementById('isPermanent-l-' + index);
                                                    let hiddenInputR = document.getElementById('isPermanent-r-' + index);

                                                    if (checkBox.checked) {
                                                        normalValue.classList.add('hidden');
                                                        permanentValue.classList.remove('hidden');
                                                        normalNumber.classList.add('hidden');
                                                        permanentNumber.classList.remove('hidden');
                                                        hiddenInputL.value = "1";
                                                        hiddenInputR.value = "1";
                                                    } else {
                                                        normalValue.classList.remove('hidden');
                                                        permanentValue.classList.add('hidden');
                                                        normalNumber.classList.remove('hidden');
                                                        permanentNumber.classList.add('hidden');
                                                        hiddenInputL.value = "0";
                                                        hiddenInputR.value = "0";
                                                    }
                                                }

                                                function numberWithCommas(x) {
                                                    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                                }

                                                @foreach ($imageDatas as $index => $imageData)
                                                    document.getElementById('number-value-{{ $index }}').textContent = numberWithCommas(
                                                        "{{ $imageData->image_value }}");

                                                    document.getElementById('number-p_value-{{ $index }}').textContent = numberWithCommas(
                                                        "{{ $imageData->image_p_value }}");

                                                    // Initialize view based on the isPermanent field
                                                    toggleValue({{ $index }});
                                                @endforeach

                                                document.addEventListener('DOMContentLoaded', () => {
                                                    const searchButton = document.getElementById('search_f');
                                                    const popupBlinkButton = document.getElementById('popup_blink');

                                                    // Check if the blink flag is set in localStorage
                                                    if (localStorage.getItem('blink') === 'true') {
                                                        popupBlinkButton.classList.add('blink-bg');
                                                        setTimeout(() => {
                                                            popupBlinkButton.classList.remove('blink-bg');
                                                            localStorage.removeItem('blink'); // Clear the flag after the blink
                                                        }, 3000); // Blink for 2 seconds
                                                    }

                                                    searchButton.addEventListener('click', () => {
                                                        // Set the blink flag in localStorage
                                                        localStorage.setItem('blink', 'true');
                                                    });
                                                });

                            
                                                document.querySelectorAll('.hasForm').forEach(form => {
                                                    const buttonHas = form.querySelector('.hasFormSubmit');

                                                    form.addEventListener('submit', function(event) {
                                                        // Prevent the default form submission
                                                        event.preventDefault();

                                                        // Disable the button to prevent multiple clicks
                                                        buttonHas.disabled = true;
                                                        buttonHas.textContent = 'Adding...'; // Change button text to indicate submission

                                                        // Optionally, you can add a small timeout to re-enable the button if needed
                                                        setTimeout(() => {
                                                            buttonHas.disabled = false;
                                                            buttonHas.textContent = 'Add Has'; // Reset button text
                                                        }, 5000); // Re-enable after 5 seconds (if needed)

                                                        // Submit the form programmatically
                                                        form.submit();
                                                    });
                                                });


                                                document.querySelectorAll('.wantForm').forEach(form => {
                                                    const buttonWant = form.querySelector('.wantFormSubmit');

                                                    form.addEventListener('submit', function(event) {
                                                        // Prevent the default form submission
                                                        event.preventDefault();

                                                        // Disable the button to prevent multiple clicks
                                                        buttonWant.disabled = true;
                                                        buttonWant.textContent = 'Adding...'; // Change button text to indicate submission

                                                        // Optionally, you can add a small timeout to re-enable the button if needed
                                                        setTimeout(() => {
                                                            buttonWant.disabled = false;
                                                            buttonWant.textContent = 'Add Want'; // Reset button text
                                                        }, 5000); // Re-enable after 5 seconds (if needed)

                                                        // Submit the form programmatically
                                                        form.submit();
                                                    });
                                                });
                                               
                                            </script>
                                            <!---end card-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pagination -->
                            <nav class="flex items-center mb-5 justify-center gap-x-1" aria-label="Pagination">
                                <!-- Previous Page Link -->
                                @if ($imageDatas->onFirstPage())
                                    <button type="button"
                                        class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                                        aria-label="Previous" disabled>
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m15 18-6-6 6-6"></path>
                                        </svg>
                                        <span>Previous</span>
                                    </button>
                                @else
                                    <a href="{{ $imageDatas->previousPageUrl() }}"
                                        class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                                        aria-label="Previous">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m15 18-6-6 6-6"></path>
                                        </svg>
                                        <span>Previous</span>
                                    </a>
                                @endif

                                <!-- Pagination Links -->
                                <div class="flex items-center gap-x-1">
                                    @foreach ($imageDatas->links()->elements[0] as $page => $url)
                                        @if ($page == $imageDatas->currentPage())
                                            <span
                                                class="min-h-[38px] min-w-[38px] flex justify-center items-center bg-gray-200 text-gray-800 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-300 dark:bg-neutral-600 dark:text-white dark:focus:bg-neutral-500"
                                                aria-current="page">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}"
                                                class="min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-100 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">{{ $page }}</a>
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Next Page Link -->
                                @if ($imageDatas->hasMorePages())
                                    <a href="{{ $imageDatas->nextPageUrl() }}"
                                        class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                                        aria-label="Next">
                                        <span>Next</span>
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m9 18 6-6-6-6"></path>
                                        </svg>
                                    </a>
                                @else
                                    <button type="button"
                                        class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                                        aria-label="Next" disabled>
                                        <span>Next</span>
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m9 18 6-6-6-6"></path>
                                        </svg>
                                    </button>
                                @endif
                            </nav>
                            <!-- End Pagination -->

                        </div>
                    </div>
                </div>

            </div>
            <!--end popup-->
        </div>

    </div>
@endsection
