@extends('layouts.main')
@section('title', 'Comments Box - Blox Fruits Calculator')
@section('description', 'Use our Blox Fruits calculator comment box to communicate with one another and finalize trades. You can also opt for private conversations to complete all trades.')
@section('main_section')
    <div
        class="overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:size-full before:-z-[1] before:transform before:-translate-x-1/2">
        <div class="max-w-6xl px-4 py-10 mx-auto">
            <h1 class="block text-2xl font-bold text-gray-600 text-center mb-3">Trades and Comments</h1>

            @foreach ($organizedTrades as $batchId => $trades)
                @php
                    $ago = \Carbon\Carbon::parse($trades['created_at']);
                    $elapsed = $ago->diffForHumans();
                @endphp

                <div class="mb-10 border shadow-md rounded-lg p-5 bg-gray-100">
                    <h2 class="text-lg font-bold text-gray-600 text-center mb-1">Post No: {{ $batchId }}</h2>
                    <div class="text-center py-1 flex items-center justify-center">
                        @if (auth()->id() !== $trades['user_id'])
                            <a href="{{ route('chat-id', $trades['user_id']) }}"
                                class="flex items-center space-x-1 text-blue-600 font-bold hover:text-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 11.25c0-5.385-4.365-9.75-9.75-9.75S2.25 5.865 2.25 11.25a9.706 9.706 0 001.142 4.575l-1.357 4.091a.75.75 0 00.937.937l4.091-1.357a9.706 9.706 0 004.575 1.142c5.385 0 9.75-4.365 9.75-9.75z" />
                                </svg>
                                <span>{{ ucfirst($trades['user']) }}</span>
                            </a>
                        @else
                            <span class="flex items-center space-x-1 text-gray-600  font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 20.25c4.97 0 9-3.589 9-8.25S16.97 3.75 12 3.75 3 7.339 3 12s4.03 8.25 9 8.25z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.75 9.75h.008v.008H9.75V9.75zM14.25 9.75h.008v.008h-.008V9.75zM9.75 14.25h4.5m-4.5-2.25h4.5" />
                                </svg>
                                <span>{{ ucfirst($trades['user']) }}</span>
                            </span>
                        @endif
                    </div>


                    <p class="text-center text-gray-500 text-sm mb-5">Created on: {{ $elapsed }}</p>

                    <!-- Display Left and Right Trades -->
                    <div class="flex flex-col justify-center items-center">
                        <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-6">

                            <!-- Left card -->
                            <div class="flex flex-col items-center">
                                <h3 class="text-center mb-4 text-[#8a8a8a] font-extrabold">I Have</h3>
                                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                                    @php
                                        $leftTrades = $trades['left'];
                                        $leftCount = $leftTrades->count();
                                    @endphp
                                    @foreach ($trades['left'] as $left)
                                        <div
                                            class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-green-100 flex flex-col items-center justify-center relative text-center">
                                            <img src="{{ asset('storage/' . $left->image) }}" alt="{{ $left->name }}"
                                                width="60" class="rounded">
                                            <p class="text-md font-semibold">{{ $left->name }}</p>
                                            <p class="text-gray-600 text-sm">
                                                @if ($left->isPermanent)
                                                    ${{ number_format($left->p_value) }}
                                                @else
                                                    ${{ number_format($left->value) }}
                                                @endif
                                            </p>
                                            <p class="text-gray-600 text-sm">
                                                @if ($left->isPermanent)
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
                                            <p class="text-lg font-semibold">Placeholder</p>
                                            <p class="text-gray-600">$0.00</p>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <!-- End Left card -->

                            <!-- Right card -->
                            <div class="flex flex-col items-center">
                                <h3 class="text-center mb-4 text-[#8a8a8a] font-extrabold">I Want</h3>
                                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                                    @php
                                        $rightTrades = $trades['right'];
                                        $rightCount = $rightTrades->count();
                                    @endphp
                                    @foreach ($trades['right'] as $right)
                                        <div
                                            class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-red-100 flex flex-col items-center justify-center relative text-center">
                                            <img src="{{ asset('storage/' . $right->image) }}" alt="{{ $right->name }}"
                                                width="60" class="rounded">
                                            <p class="text-md font-semibold">{{ $right->name }}</p>
                                            <p class="text-gray-600 text-sm">
                                                @if ($right->isPermanent)
                                                    ${{ number_format($right->p_value) }}
                                                @else
                                                    ${{ number_format($right->value) }}
                                                @endif
                                            </p>
                                            <p class="text-gray-600 text-sm">
                                                @if ($right->isPermanent)
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
                                            <p class="text-lg font-semibold">Placeholder</p>
                                            <p class="text-gray-600">$0.00</p>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <!-- End Right card -->
                        </div>
                    </div>


                    <!-- Display Comments -->
                    <div class="mt-6 w-full">
                        <h3 class="font-bold text-lg">Comments:</h3>
                        @forelse ($commentid as $comment)
                            <div class="border-t pt-2">
                                <p><strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            <p>No comments yet.</p>
                        @endforelse
                    </div>


                    <!-- Add Comment Form -->
                    <div class="mt-4 ">
                        <div>
                            <form action="{{ route('comments.store', ['tradeId' => $batchId]) }}" method="POST">
                                @csrf
                                <textarea name="comment" rows="3" class="w-full border rounded-lg p-2 mb-5" placeholder="Add a comment..."></textarea>
                                <button type="submit" class="cmt-btn">
                                    <span class="circle1"></span>
                                    <span class="circle2"></span>
                                    <span class="circle3"></span>
                                    <span class="circle4"></span>
                                    <span class="circle5"></span>
                                    <span class="text">Submit</span>
                                </button>
                            </form>
                            <a href="{{ route('dashboard') }}">
                                <button class="mt-3">
                                    <div class="svg-wrapper-1">
                                        <div class="svg-wrapper">
                                            <svg viewBox="0 0 24 24" width="40px" height="40px" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                                                        stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M9.00002 15.3802H13.92C15.62 15.3802 17 14.0002 17 12.3002C17 10.6002 15.62 9.22021 13.92 9.22021H7.15002"
                                                        stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M8.57 10.7701L7 9.19012L8.57 7.62012" stroke="#292D32"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </path>
                                                </g>
                                            </svg>
                                        </div>
                                        <div>Back</div>
                                    </div>
                                </button>
                            </a>
                        </div>

                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
