@extends('layouts.main')
@section('main_section')
    <div class="mt-10 mb-10">

        <div class="flex justify-center mb-10">
            <form action="{{ route('flush.session') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-400 text-black font-bold py-2 px-4 rounded hover:bg-yellow-500">
                    ⚠️ Flush Session (2H AGO)
                </button>
            </form>
        </div>

        <div class="flex justify-center mb-10">
            <form action="{{ route('chat.delete') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-400 text-black font-bold py-2 px-4 rounded hover:bg-yellow-500">
                    ⚠️ Delete 30 days old messages
                </button>
            </form>
        </div>


        <div class="flex justify-center mb-10">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-400 text-black font-bold py-2 px-4 rounded hover:bg-yellow-500">
                    ⚠️ Logout Admin
                </button>
            </form>
        </div>

 
        <h2 class="text-center font-bold mb-5">Upload the images</h2>
        <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data"
            class="max-w-4xl mx-auto p-4 border rounded">
            @csrf

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Image:</label>
                <input type="file" name="image" id="image" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="image_name" class="block text-sm font-medium text-gray-700">Image Name:</label>
                <input type="text" name="image_name" id="image_name" maxlength="60" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="image_value" class="block text-sm font-medium text-gray-700">Image Value Number:</label>
                <input type="text" name="image_value" id="image_value" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="image_p_value" class="block text-sm font-medium text-gray-700">Image Permanent Number:</label>
                <input type="text" name="image_p_value" id="image_p_value" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                <input type="text" name="price" id="price" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <button type="submit" class="bg-blue-700 text-white rounded-md w-full p-1">Submit</button>
        </form>

        <div class="flex flex-col items-center mt-10">
            <h2 class="text-center font-bold mb-5">Uploaded Images</h2>
            @if (session('success'))
                <div class="px-2 py-1 rounded text-center mt-10 mb-10 text-red-600">
                    {{ session('success') }}
                </div>
            @endif

            <div>
                <table class="table-auto border-collapse border">
                    <thead>
                        <tr class="text-left">
                            <th class="px-4 py-2 border">Id</th>
                            <th class="px-4 py-2 border">Image</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Value</th>
                            <th class="px-4 py-2 border">Permanent Value</th>
                            <th class="px-4 py-2 border">Price</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($imageDatas as $imageData)
                            <tr class="bg-white hover:bg-gray-100">
                                <td class="px-4 py-2 border">{{ $imageData->image_id }}</td>

                                <td class="px-4 py-2 border-b">
                                    <img src="{{ asset('storage/' . $imageData->image) }}"
                                        alt="{{ $imageData->image_name }}" width="100" class="rounded">
                                </td>
                                <td class="px-4 py-2 border">{{ $imageData->image_name }}</td>
                                <td class="px-4 py-2 border">{{ $imageData->image_value }}</td>
                                <td class="px-4 py-2 border">{{ $imageData->image_p_value }}</td>
                                <td class="px-4 py-2 border">{{ $imageData->price }}</td>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('images.edit', $imageData->image_id) }}"
                                        class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('images.destroy', $imageData->image_id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
        <div class="mt-4 flex justify-center">
            {{ $imageDatas->links('components.pagination') }}
        </div>
    </div>
@endsection
