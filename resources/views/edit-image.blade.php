@extends('layouts.main')
@section('main_section')

<form action="{{ route('images.update', $imageDatas->image_id ) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto p-4 border rounded">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-gray-700">Image:</label>
        <input type="file" name="image" id="image" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div class="mb-4">
        <label for="image_name" class="block text-sm font-medium text-gray-700">Image Name:</label>
        <input type="text" name="image_name" id="image_name" maxlength="60" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        value="{{$imageDatas->image_name}}">
    </div>

    <div class="mb-4">
        <label for="image_value" class="block text-sm font-medium text-gray-700">Image Value Number:</label>
        <input type="text" name="image_value" id="image_value" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        value="{{$imageDatas->image_value}}">
    </div>

    <div class="mb-4">
        <label for="image_p_value" class="block text-sm font-medium text-gray-700">Image Permanent Number:</label>
        <input type="text" name="image_p_value" id="image_p_value" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        value="{{$imageDatas->image_p_value }}">
    </div>

    <div class="mb-4">
        <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
        <input type="text" name="price" id="price" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        value="{{$imageDatas->price }}">
    </div>

    <button type="submit" class="bg-blue-700 text-white rounded-md w-full p-1">Submit</button>
</form>

@endsection