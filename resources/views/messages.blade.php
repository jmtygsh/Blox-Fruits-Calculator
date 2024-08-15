@extends('layouts.main')
@section('title', 'All Messages - Blox Fruits Calculator')
@section('description', 'This is your message dashboard. Here, you can see everything related to messages, engage in private chatting, and join chatting rooms to converse with other users to complete trades. ')
@section('main_section')

<form method="GET" action="{{ route('chat.dashboard') }}">
    <div class="relative overflow-hidden before:absolute before:top-0 before:left-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[1] before:transform before:-translate-x-1/2">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-mx-4 sm:-mx-6 lg:-mx-8 overflow-x-auto">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow-sm border border-gray-200 bg-white">
                            <!-- Header -->
                            <div class="px-4 py-3 sm:px-6 sm:py-4 lg:px-8 lg:py-5 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
                                <!-- Input -->
                                <div class="flex-1 sm:max-w-xs">
                                    <label for="hs-as-table-product-review-search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <input type="text" id="hs-as-table-product-review-search"
                                               name="search"
                                               value="{{ request('search') }}"
                                               class="block w-full py-2 px-3 pl-10 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none bg-gray-300 text-black placeholder-gray-500"
                                               placeholder="Search">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                 width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <circle cx="11" cy="11" r="8" />
                                                <path d="m21 21-4.3-4.3" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Input -->

                                <div class="mt-3 md:mt-0 flex justify-end gap-2">
                                    <div class="hs-dropdown relative inline-block" data-hs-dropdown-auto-close="inside">
                                        <button id="hs-as-table-table-filter-dropdown" type="button"
                                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 6h18" />
                                                <path d="M7 12h10" />
                                                <path d="M10 18h4" />
                                            </svg>
                                            Filter
                                            <span class="pl-2 text-xs font-semibold text-blue-600 border-l border-gray-200">
                                                1
                                            </span>
                                        </button>
                                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden divide-y divide-gray-200 min-w-[12rem] z-10 bg-white shadow-md rounded-lg mt-2"
                                             role="menu" aria-orientation="vertical"
                                             aria-labelledby="hs-as-table-table-filter-dropdown">
                                            <div class="divide-y divide-gray-200">
                                                <label for="hs-as-filters-dropdown-latest" class="flex py-2.5 px-3">
                                                    <input type="radio" name="filter" value="latest" id="hs-as-filters-dropdown-latest"
                                                           class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none bg-white checked:bg-blue-500 checked:border-blue-500 focus:ring-offset-white"
                                                           {{ request('filter') == 'latest' ? 'checked' : '' }}>
                                                    <span class="ml-3 text-sm text-gray-800">Latest</span>
                                                </label>
                                                <label for="hs-as-filters-dropdown-oldest" class="flex py-2.5 px-3">
                                                    <input type="radio" name="filter" value="oldest" id="hs-as-filters-dropdown-oldest"
                                                           class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none bg-white checked:bg-blue-500 checked:border-blue-500 focus:ring-offset-white"
                                                           {{ request('filter') == 'oldest' ? 'checked' : '' }}>
                                                    <span class="ml-3 text-sm text-gray-800">Oldest</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-lg">Apply</button>
                                </div>
                            </div>
                            <!-- End Header -->

                            <!-- Your existing message display code -->
                            @foreach ($messages as $message)
                                <!-- Table -->
                                <table class="min-w-full divide-y divide-gray-200 border">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left">
                                                <div class="flex items-center gap-x-2">
                                                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                                        UserName
                                                    </span>
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left">
                                                <div class="flex items-center gap-x-2">
                                                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                                        Comments
                                                    </span>
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left">
                                                <div class="flex items-center gap-x-2">
                                                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                                        Date
                                                    </span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <tr class="bg-white hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <a href="{{ route('chat-id', $message->sender_id) }}">
                                                    {{ $message->sender->name }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-blue-500">
                                                <a href="{{ route('chat-id', $message->sender_id) }}">
                                                    {{ $message->message }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                <a href="{{ route('chat-id', $message->sender_id) }}">
                                                    {{ $message->created_at->format('d M Y') }}
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Table Section -->
    </div>
</form>

@endsection
