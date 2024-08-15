<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat - Blox Fruits Calculator</title>
    <link rel="icon" href="{{ asset('storage/images/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('storage/images/favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chat.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="flex flex-col h-screen">
    <!-- Header -->
    <header
        class="fixed top-0 left-0 w-full bg-white text-black h-16 flex items-center justify-between px-4 shadow-md z-10">
        <!-- Back Button -->
        <a href="{{ route('chat.dashboard') }}" class="text-white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8">
                <path
                    d="M9.41 11H17a1 1 0 0 1 0 2H9.41l2.3 2.3a1 1 0 1 1-1.42 1.4l-4-4a1 1 0 0 1 0-1.4l4-4a1 1 0 0 1 1.42 1.4L9.4 11z" />
            </svg>
        </a>

        <div class="text-lg font-bold">
            {{ ucfirst($otherUser) }}

            @if ($isOnline)
                <span
                    class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                    Online
                </span>
            @else
                <span
                    class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                    </svg>
                    Offline
                </span>
            @endif
        </div>
        <!-- 3 Dots -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8">
            <path fill-rule="evenodd"
                d="M12 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
        </svg>
    </header>

    <!-- Messages List -->
    <main class="flex-1 flex flex-col-reverse overflow-y-auto p-4 my-20">
        <ul id="messagesList" class="space-y-4">
            @foreach ($messages as $message)
                @if ($message->sender_id == auth()->id())
                    <li class="flex items-start space-x-2">
                        <div class="flex-1 max-w-xs ml-auto">
                            <div class="bg-blue-600 text-white p-3 rounded-lg shadow-md">
                                <p class="text-sm">{{ $message->message }}</p>
                            </div>
                        </div>
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-gray-600 text-white rounded-full flex items-center justify-center text-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </li>
                @else
                    <li class="flex items-start space-x-2">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-gray-600 text-white rounded-full flex items-center justify-center text-sm">
                            {{ strtoupper(substr($otherUser, 0, 1)) }}
                        </div>
                        <div class="flex-1 max-w-xs">
                            <div class="bg-gray-200 text-gray-800 p-3 rounded-lg shadow-md border border-gray-200">
                                <p class="text-sm">{{ $message->message }}</p>
                            </div>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </main>

    <!-- Message Form -->
    <form id="messageForm" action="{{ route('chat.messages', $id) }}" method="POST"
        class="fixed bottom-0 left-0 w-full bg-white shadow-md flex items-center p-4">
        @csrf
        <textarea id="messageInput" name="message" rows="1" placeholder="Type your message..."
            class="flex-1 p-2 mr-2 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-blue-400"></textarea>
        <button type="submit"
            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition duration-200">
            <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
                <circle cx="16" cy="16" r="14" fill="url(#paint0_linear_87_7225)"></circle>
                <path
                    d="M22.9866 10.2088C23.1112 9.40332 22.3454 8.76755 21.6292 9.082L7.36482 15.3448C6.85123 15.5703 6.8888 16.3483 7.42147 16.5179L10.3631 17.4547C10.9246 17.6335 11.5325 17.541 12.0228 17.2023L18.655 12.6203C18.855 12.4821 19.073 12.7665 18.9021 12.9426L14.1281 17.8646C13.665 18.3421 13.7569 19.1512 14.314 19.5005L19.659 22.8523C20.2585 23.2282 21.0297 22.8506 21.1418 22.1261L22.9866 10.2088Z"
                    fill="white"></path>
                <defs>
                    <linearGradient id="paint0_linear_87_7225" x1="16" y1="2" x2="16"
                        y2="30" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#37BBFE"></stop>
                        <stop offset="1" stop-color="#007DBB"></stop>
                    </linearGradient>
                </defs>
            </svg>
        </button>
    </form>

    <script>
        window.authID = @json(auth()->id());
        window.sID = @json($id);
        window.authNameInitial = '{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}';
    </script>
</body>
</html>