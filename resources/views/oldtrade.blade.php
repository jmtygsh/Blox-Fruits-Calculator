@extends('layouts.main')
@section('title', 'Your Old Trades - Blox Fruits Calculator')
@section('description', "View your past trades and once they're complete, you can delete them. You can also edit the value of your custom items to make trading easier.")
@section('main_section')
    <div
        class="overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:size-full before:-z-[1] before:transform before:-translate-x-1/2">
        <div class="max-w-6xl px-4 py-10 mx-auto">
            <h1 class="block text-2xl font-bold text-gray-600 text-center mb-3">Your Old Trades</h1>
            <p class="text-center mb-10 text-gray-600">Select the items you have and the items that you want to trade for &
                Submit it</p>

            <!-- Loop through grouped trades by batch_id -->
            @foreach ($groupedTrades as $batchId => $trades)
                @php
                    // Calculate elapsed time for each batch
                    $ago = $trades['created_at'];
                    $ago = Carbon\Carbon::parse($ago);
                    $elapsed = $ago->diffForHumans();
                @endphp
                <div class="mb-10 border shadow-md rounded-lg p-5">
                    <h2 class="text-xl font-bold text-gray-600 text-center mb-2">Post No: {{ $batchId }}</h2>
                    <p class="text-center text-gray-500 mb-5">Created on: {{ $elapsed }}</p>
                    <div class="flex flex-col justify-center items-center">
                        <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-6">
                            <!-- Left card -->
                            <div class="flex flex-col items-center">
                                <h3 class="text-center mb-4 text-[#8a8a8a] font-extrabold">Has</h3>
                                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                                    @php
                                        $leftTrades = $trades['left'];
                                        $leftCount = $leftTrades->count();
                                    @endphp
                                    @foreach ($leftTrades as $left)
                                        <div
                                            class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-green-100 flex flex-col items-center justify-center relative text-center">
                                            <!-- Edit Button -->
                                            <form
                                                action="{{ route('trade.edit', ['batchid' => $batchId, 'id' => $left->id]) }}"
                                                method="GET" class="absolute top-2 right-2">
                                                @csrf
                                                <button
                                                    class="text-black inline-flex items-center justify-center gap-x-2 text-sm font-semibold border-transparent  hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none">
                                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        fill="#000000" width="20px">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <title></title>
                                                            <g id="Complete">
                                                                <g id="edit">
                                                                    <g>
                                                                        <path
                                                                            d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8"
                                                                            fill="none" stroke="#000000"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"></path>
                                                                        <polygon fill="none"
                                                                            points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8"
                                                                            stroke="#000000" stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2">
                                                                        </polygon>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </form>

                                            <!-- Other Content -->
                                            <img src="{{ asset('storage/' . $left->image) }}" alt="{{ $left->name }}"
                                                width="60" class="rounded">
                                            <p class="text-md font-semibold">{{ $left->name }}</p>
                                            <p class="text-gray-600 text-sm">
                                                <span>
                                                    @if ($left->isPermanent)
                                                        ${{ number_format($left->p_value) }}
                                                    @else
                                                        ${{ number_format($left->value) }}
                                                    @endif
                                                </span>
                                            </p>
                                            <p class="text-gray-600 text-sm" >

                                                @if ($left->isPermanent == 1)
                                                    <span>Permanent value</span>
                                                @else
                                                    <span>Normal Value</span>
                                                @endif

                                            </p>
                                        </div>
                                    @endforeach
                                    @for ($i = $leftCount; $i < 2; $i++)
                                        <div
                                            class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-[#f0f8ff] flex flex-col items-center justify-center">
                                            <img src="{{ asset('storage/images/demo.svg') }}" alt="Demo Image"
                                                width="60" class="rounded">
                                            <p class="text-lg font-semibold text-center">Placeholder</p>
                                            <p class="text-gray-600 text-center">$0.00</p>
                                            <p class="text-gray-600 text-sm text-center">Demo Value</p>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <!-- End Left card -->

                            <!-- Right card -->
                            <div class="flex flex-col items-center">
                                <h3 class="text-center mb-4 text-[#8a8a8a] font-extrabold">Wants</h3>
                                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                                    @php
                                        $rightTrades = $trades['right'];
                                        $rightCount = $rightTrades->count();
                                    @endphp
                                    @foreach ($rightTrades as $right)
                                        <div
                                            class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-red-100 flex flex-col items-center justify-center relative text-center">
                                            <!-- Edit Button -->
                                            <form
                                                action="{{ route('trade.edit', ['batchid' => $batchId, 'id' => $right->id]) }}"
                                                method="GET" class="absolute top-2 right-2">
                                                @csrf
                                                <button
                                                    class="text-black inline-flex items-center justify-center gap-x-2 text-sm font-semibold border-transparent  hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none">
                                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                        fill="#000000" width="20px">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <title></title>
                                                            <g id="Complete">
                                                                <g id="edit">
                                                                    <g>
                                                                        <path
                                                                            d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8"
                                                                            fill="none" stroke="#000000"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"></path>
                                                                        <polygon fill="none"
                                                                            points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8"
                                                                            stroke="#000000" stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2">
                                                                        </polygon>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </form>

                                            <!-- Other Content -->
                                            <img src="{{ asset('storage/' . $right->image) }}" alt="{{ $right->name }}"
                                                width="60" class="rounded">
                                            <p class="text-md font-semibold">{{ $right->name }}</p>
                                            <p class="text-gray-600 text-sm">
                                                <span>
                                                    @if ($right->isPermanent)
                                                        ${{ number_format($right->p_value) }}
                                                    @else
                                                        ${{ number_format($right->value) }}
                                                    @endif
                                                </span>
                                            </p>
                                            <p class="text-gray-600 text-sm">

                                                @if ($right->isPermanent == 1)
                                                    <span>Permanent value</span>
                                                @else
                                                    <span>Normal Value</span>
                                                @endif

                                            </p>
                                        </div>
                                    @endforeach


                                    @for ($i = $rightCount; $i < 2; $i++)
                                        <div
                                            class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-[#f0f8ff] flex flex-col items-center justify-center">
                                            <img src="{{ asset('storage/images/demo.svg') }}" alt="Demo Image"
                                                width="60" class="rounded">
                                            <p class="text-lg font-semibold text-center">Placeholder</p>
                                            <p class="text-gray-600 text-center">$0.00</p>
                                            <p class="text-gray-600 text-sm text-center">Demo Value</p>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <!-- End Right card -->
                        </div>
                    </div>
                    <div class="flex justify-center gap-5 flex-wrap mt-5">


                        <form action="{{ route('trade.delete', $batchId) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-64 bg-red-400 text-black h-12 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border shadow-md border-transparent border-custom hover:bg-red-200 disabled:opacity-50 disabled:pointer-events-none">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    width="20px">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M10 12V17" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M14 12V17" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M4 7H20" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10"
                                            stroke="#000000" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                            stroke="#000000" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                Delete Trade
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
