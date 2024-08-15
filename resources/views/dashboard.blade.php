@extends('layouts.main')
@section('title', 'All Trades - Blox Fruits Calculator')
@section('description', 'Explore the dashboard where users share their fruit trade offers and collaborate to complete successful exchanges. List your fruits, find trade partners, and close deals with ease.')
@section('main_section')
    <div
        class="overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:size-full before:-z-[1] before:transform before:-translate-x-1/2">
        <div class="max-w-6xl px-4 py-10 mx-auto">
            <h1 class="block text-2xl font-bold text-gray-600 text-center mb-3">All Trades</h1>
            <p class="text-center mb-10 text-gray-600">Trade with other users, Choose a post and complete the trade.</p>

            <!-- Search and Filter Form -->
            <form action="{{ route('dashboard') }}" method="GET" class="mb-8">
                <div class="flex flex-col md:flex-row md:justify-center md:space-x-4 space-y-4 md:space-y-0">
                    <!-- Search by fruits -->
                    <input type="text" name="search" value="{{ request()->input('search') }}"
                        placeholder="Search by fruits..."
                        class="border border-gray-300 rounded-lg w-full md:w-80 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <!-- Search by Post ID -->
                    <input type="number" name="post_id" value="{{ request()->input('post_id') }}" placeholder="Post ID"
                        class="border border-gray-300 rounded-lg w-full md:w-40 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <!-- Sort by Date -->
                    <select name="sort"
                        class="border border-gray-300 rounded-lg w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="desc" {{ request()->input('sort') == 'desc' ? 'selected' : '' }}>Newest First
                        </option>
                        <option value="asc" {{ request()->input('sort') == 'asc' ? 'selected' : '' }}>Oldest First
                        </option>
                    </select>

                    <!-- Filter by Online Status -->
                    <select name="status"
                        class="border border-gray-300 rounded-lg w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" {{ request()->input('status') == '' ? 'selected' : '' }}>All Users</option>
                        <option value="online" {{ request()->input('status') == 'online' ? 'selected' : '' }}>Online Users
                        </option>
                        <option value="offline" {{ request()->input('status') == 'offline' ? 'selected' : '' }}>Offline
                            Users</option>
                    </select>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 w-full md:w-auto">
                        Apply Filters
                    </button>
                </div>
            </form>


            <!-- Loop through organized trades by batch_id -->
            @foreach ($organizedTrades as $batchId => $trades)
                @php
                    // Calculate elapsed time for each batch
                    $ago = $trades['created_at'];
                    $ago = \Carbon\Carbon::parse($ago);
                    $elapsed = $ago->diffForHumans();
                @endphp

                <div class="mb-10 border shadow-md rounded-lg p-5">
                    <h2 class="text-lg font-bold text-gray-600 text-center mb-1">Post No: {{ $batchId }}</h2>

                    <div class="text-center py-1">
                        {{ ucfirst($trades['user']) }}

                        @if ($trades['isOnline'])
                            <span
                                class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </svg>
                            </span>
                        @else
                            <span
                                class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                </svg>

                            </span>
                        @endif
                    </div>

                    <p class="text-center text-gray-500 mb-5 text-sm">Created on: {{ $elapsed }}</p>
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
                                    @foreach ($leftTrades as $left)
                                        <div
                                            class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-green-100 flex flex-col items-center justify-center relative text-center">
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
                                <h3 class="text-center mb-4 text-[#8a8a8a] font-extrabold">I Want</h3>
                                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                                    @php
                                        $rightTrades = $trades['right'];
                                        $rightCount = $rightTrades->count();
                                    @endphp
                                    @foreach ($rightTrades as $right)
                                        <div
                                            class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-red-100 flex flex-col items-center justify-center relative  text-center">
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
                        <form action="{{ route('comments.ind', $batchId) }}" method="GET">
                            @csrf
                            <button type="submit"
                                class="w-64 bg-blue-400 text-black h-12 inline-flex items-center justify-center  text-md font-semibold rounded-lg border shadow-md border-transparent border-custom hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none">
                                <svg viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    width="25px">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.5 12C5.49988 14.613 6.95512 17.0085 9.2741 18.2127C11.5931 19.4169 14.3897 19.2292 16.527 17.726L19.5 18V12C19.5 8.13401 16.366 5 12.5 5C8.63401 5 5.5 8.13401 5.5 12Z"
                                            stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M9.5 13.25C9.08579 13.25 8.75 13.5858 8.75 14C8.75 14.4142 9.08579 14.75 9.5 14.75V13.25ZM13.5 14.75C13.9142 14.75 14.25 14.4142 14.25 14C14.25 13.5858 13.9142 13.25 13.5 13.25V14.75ZM9.5 10.25C9.08579 10.25 8.75 10.5858 8.75 11C8.75 11.4142 9.08579 11.75 9.5 11.75V10.25ZM15.5 11.75C15.9142 11.75 16.25 11.4142 16.25 11C16.25 10.5858 15.9142 10.25 15.5 10.25V11.75ZM9.5 14.75H13.5V13.25H9.5V14.75ZM9.5 11.75H15.5V10.25H9.5V11.75Z"
                                            fill="#000000"></path>
                                    </g>
                                </svg>
                                Comment
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
