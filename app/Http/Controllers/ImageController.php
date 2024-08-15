<?php

namespace App\Http\Controllers;

use App\Models\AllTrade;
use Illuminate\Http\Request;
use App\Models\ImageData;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,gif,svg|max:2048', // Allow SVG files
            'image_name' => 'required|string|max:60',
            'image_value' => 'required|numeric',
            'image_p_value' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // Handle image upload
        $path = $request->file('image')->store('upload', 'public');

        // Store data in the database
        ImageData::create([
            'image' => $path,
            'image_name' => $request->image_name,
            'image_value' => $request->image_value,
            'image_p_value' => $request->image_p_value,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Image data stored successfully!');
    }

    public function view()
    {
        $imageDatas = ImageData::paginate(10);
        $data = compact('imageDatas');
        return view('image')->with($data);
    }


    public function edit($id)
    {
        $imageDatas = ImageData::find($id);
        return view('edit-image', compact('imageDatas'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|mimes:jpg,jpeg,png,gif,svg|max:2048', // Allow SVG files
            'image_name' => 'required|string|max:60',
            'image_value' => 'required|numeric',
            'image_p_value' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $imageData = ImageData::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($imageData->image);

            // Handle new image upload
            $file = $request->file('image');
            $originalName = $imageData->image_name;
            $extension = $file->getClientOriginalExtension();
            $newName = $originalName . '_' . time() . '.' . $extension; 
            $path = $file->storeAs('upload', $newName, 'public');
            $imageData->image = $path;


            AllTrade::where('card_id', $id)->update(['image' => $path]);
        }

        // Update other data
        $imageData->image_name = $request->image_name;
        $imageData->image_value = $request->image_value;
        $imageData->image_p_value = $request->image_p_value;
        $imageData->price = $request->price;
        $imageData->save();

        return redirect('/admin/images');
    }

    public function destroy($id)
    {
        $imageData = ImageData::findOrFail($id);

        // Delete image file
        Storage::disk('public')->delete($imageData->image);

        // Delete data from database
        $imageData->delete();

        return redirect()->back()->with('success', 'Image data deleted successfully!');
    }
}
