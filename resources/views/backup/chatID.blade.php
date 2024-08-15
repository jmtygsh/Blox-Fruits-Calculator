<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat - Blox Fruits Calculator</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chat.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="relative h-screen">
        <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    
            <div class="sticky top-0 bg-black text-white rounded-md z-10 shadow-sm p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800">
                            <svg fill="currentColor" height="24px" width="24px" version="1.1" id="Capa_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 219.151 219.151" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <path
                                            d="M109.576,219.151c60.419,0,109.573-49.156,109.573-109.576C219.149,49.156,169.995,0,109.576,0S0.002,49.156,0.002,109.575 C0.002,169.995,49.157,219.151,109.576,219.151z M109.576,15c52.148,0,94.573,42.426,94.574,94.575 c0,52.149-42.425,94.575-94.574,94.576c-52.148-0.001-94.573-42.427-94.573-94.577C15.003,57.427,57.428,15,109.576,15z">
                                        </path>
                                        <path
                                            d="M94.861,156.507c2.929,2.928,7.678,2.927,10.606,0c2.93-2.93,2.93-7.678-0.001-10.608l-28.82-28.819l83.457-0.008 c4.142-0.001,7.499-3.358,7.499-7.502c-0.001-4.142-3.358-7.498-7.5-7.498l-83.46,0.008l28.827-28.825 c2.929-2.929,2.929-7.679,0-10.607c-1.465-1.464-3.384-2.197-5.304-2.197c-1.919,0-3.838,0.733-5.303,2.196l-41.629,41.628 c-1.407,1.406-2.197,3.313-2.197,5.303c0.001,1.99,0.791,3.896,2.198,5.305L94.861,156.507z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </a>
                        <img src="https://via.placeholder.com/40" alt="User Avatar"
                            class="w-10 h-10 rounded-full shadow-sm">
                        <h2 class="text-lg font-semibold text-gray-800">{{ ucfirst($otherUser) }}</h2>
                    </div>
                    <!-- Optionally, you can add more elements here, such as a settings button or notification icon -->
                </div>
            </div>
    
    
            <ul class="mt-16 space-y-5" id="messagesList">
                @foreach ($messages as $message)
                    @if ($message->sender_id == auth()->id())
                        <li id="sender" class="max-w-2xl ms-auto flex justify-end gap-x-2 sm:gap-x-4">
                            <div class="grow text-end space-y-3">
                                <div class="inline-block bg-blue-600 rounded-lg p-2 shadow-sm">
                                    <p class="text-sm text-white">{{ $message->message }}</p>
                                </div>
                            </div>
                            <div>
                                <span
                                    class="shrink-0 inline-flex items-center justify-center size-[35px] rounded-full bg-gray-600">
                                    <span
                                        class="text-sm font-medium text-white leading-none">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                </span>
                            </div>
                        </li>
                    @else
                        <li id="receiver" class="flex gap-x-2 sm:gap-x-4">
                            <span
                                class="shrink-0 inline-flex items-center justify-center size-[35px] rounded-full bg-gray-600">
                                <span
                                    class="text-sm font-medium text-white leading-none">{{ strtoupper(substr($otherUser, 0, 1)) }}</span>
                            </span>
                            <div
                                class="bg-white border border-gray-200 rounded-lg p-2 space-y-3 dark:bg-neutral-900 dark:border-neutral-700">
                                <p class="font-medium text-gray-800 dark:text-white">{{ $message->message }}</p>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    
        <div
            class="max-w-4xl mx-auto sticky bottom-0 z-10 bg-white border-t border-gray-200 pt-2 pb-4 sm:pt-4 sm:pb-6 px-4 sm:px-6 lg:px-0">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <form id="messageForm" action="{{ route('test-messages', $id) }}" method="POST">
                    @csrf
                    <div class="relative">
                        <textarea
                            class="p-4 pb-12 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            placeholder="message..." name="message" id="messageInput"></textarea>
                        <div class="absolute bottom-px inset-x-px p-2 rounded-b-lg bg-white dark:bg-neutral-900">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <button type="button"
                                        class="inline-flex shrink-0 justify-center items-center size-8 rounded-lg text-gray-500 hover:bg-gray-100 focus:z-10 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex items-center gap-x-1">
                                    <button type="submit"
                                        class="inline-flex shrink-0 justify-center items-center size-8 rounded-lg text-white bg-blue-600 hover:bg-blue-500 focus:z-10 focus:outline-none focus:bg-blue-500">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <script>
        window.authID = @json(auth()->id());
        window.sID = @json($id);
        window.authNameInitial = '{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}';
    </script>
</body>

</html>
