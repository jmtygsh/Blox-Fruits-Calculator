@extends('layouts.main')

@section('main_section')
    <div class="relative overflow-hidden bg-cover bg-no-repeat bg-center"
        style="background-image: url('https://preline.co/assets/svg/examples/polygon-bg-element.svg');">
        <div class="max-w-6xl px-4 py-10 mx-auto relative z-10">
            <h1 class="text-2xl font-bold text-gray-600 text-center mb-3">Edit Trade</h1>
            <p class="text-center mb-10 text-gray-600">Update the details of the selected trade.</p>

            <!-- Update Form -->
            <div class="flex flex-col items-center">
                <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-6">
                    <!-- Trade Details -->
                    <div class="flex flex-col items-center">
                        <h3 class="text-center mb-4 text-gray-600 font-extrabold">Trade Details</h3>
                        <form action="{{ route('trade.update', ['batchid' => $batchId, 'id' => $id]) }}" method="POST"
                            class="w-full max-w-md">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" value="{{ $trade->name }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label for="value" class="block text-sm font-medium text-gray-700">Value</label>
                                <input type="text" name="value" id="value" value="{{ $trade->value }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label for="p_value" class="block text-sm font-medium text-gray-700">Permanent
                                    Value</label>
                                <input type="text" name="p_value" id="p_value" value="{{ $trade->p_value }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label for="isPermanent" class="block text-sm font-medium text-gray-700">Set a
                                    permanent?</label>
                                <select name="isPermanent" id="isPermanent"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="1" {{ $trade->isPermanent == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $trade->isPermanent == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="text" name="price" id="price" value="{{ $trade->price }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label for="isSide" class="block text-sm font-medium text-gray-700">Is Side</label>
                                <select name="isSide" id="isSide"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="1" {{ $trade->isSide == 1 ? 'selected' : '' }}>Want</option>
                                    <option value="0" {{ $trade->isSide == 0 ? 'selected' : '' }}>Has</option>
                                </select>
                            </div>

                            <button type="submit"
                                class="w-64 bg-blue-400 text-black h-12 flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent shadow-md hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none">
                                <svg fill="#000000" viewBox="0 0 24 24" id="update" xmlns="http://www.w3.org/2000/svg"
                                    class="icon flat-line" width="20px">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path id="primary" d="M4,12A8,8,0,0,1,18.93,8"
                                            style="fill: none; stroke: #000000; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                        </path>
                                        <path id="primary-2" data-name="primary" d="M20,12A8,8,0,0,1,5.07,16"
                                            style="fill: none; stroke: #000000; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                        </path>
                                        <polyline id="primary-3" data-name="primary" points="14 8 19 8 19 3"
                                            style="fill: none; stroke: #000000; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                        </polyline>
                                        <polyline id="primary-4" data-name="primary" points="10 16 5 16 5 21"
                                            style="fill: none; stroke: #000000; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                        </polyline>
                                    </g>
                                </svg>
                                Update Now
                            </button>
                        </form>

                        <form action="{{ route('old.trade') }}" method="GET" class="mt-4">
                            @csrf
                            <button type="submit"
                                class="w-64 bg-blue-400 text-black h-12 flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent shadow-md hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="20px">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM13.92 16.13H9C8.59 16.13 8.25 15.79 8.25 15.38C8.25 14.97 8.59 14.63 9 14.63H13.92C15.2 14.63 16.25 13.59 16.25 12.3C16.25 11.01 15.21 9.97 13.92 9.97H8.85L9.11 10.23C9.4 10.53 9.4 11 9.1 11.3C8.95 11.45 8.76 11.52 8.57 11.52C8.38 11.52 8.19 11.45 8.04 11.3L6.47 9.72C6.18 9.43 6.18 8.95 6.47 8.66L8.04 7.09C8.33 6.8 8.81 6.8 9.1 7.09C9.39 7.38 9.39 7.86 9.1 8.15L8.77 8.48H13.92C16.03 8.48 17.75 10.2 17.75 12.31C17.75 14.42 16.03 16.13 13.92 16.13Z"
                                            fill="#292D32"></path>
                                    </g>
                                </svg>
                                Go Back
                            </button>
                        </form>
                    </div>

                    <!-- Preview Card -->
                    <div class="flex flex-col items-center">
                        <h3 class="text-center mb-4 text-gray-600 font-extrabold">Image</h3>
                        <div
                            class="w-full px-10 py-4 border border-gray-400 rounded-lg shadow-md bg-green-100 flex flex-col items-center justify-center">
                            <img src="{{ asset('storage/' . $trade->image) }}" alt="{{ $trade->name }}" width="80"
                                class="rounded mb-2">
                            <p class="text-lg font-semibold">{{ $trade->name }}</p>
                            <p class="text-gray-600">
                                $<span>
                                    @if ($trade->isPermanent == 1)
                                        {{ number_format($trade->p_value) }}
                                    @else
                                        {{ number_format($trade->value) }}
                                    @endif
                                </span>
                            </p>
                            <p class="text-gray-600">

                                @if ($trade->isPermanent == 1)
                                <span>Permanent value</span>
                                @else
                                <span>Normal Value</span>
                                @endif

                            </p>
                            <p class="text-gray-600">Price: ${{ number_format($trade->price) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
