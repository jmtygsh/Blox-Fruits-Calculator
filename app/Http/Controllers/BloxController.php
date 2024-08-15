<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeftSelectedCard;
use App\Models\RightSelectedCard;
use Illuminate\Support\Facades\Session;
use App\Models\ImageData;
use Illuminate\Support\Facades\Log;

class BloxController extends Controller
{
    public function Index(Request $request)
    {
        $userId = Session::get('user_id');
        $leftdata = LeftSelectedCard::where('user_id', $userId)->get();
        $rightdata = RightSelectedCard::where('user_id', $userId)->get();

        // Alternatively, filter based on other criteria as needed
        $search = $request->search;

        $search = $request->search;

        if (!empty($search)) {
            $imageDatas = ImageData::where('image_name', 'LIKE', "%$search%")->paginate(10);
        } else {
            $imageDatas = ImageData::paginate(2);
        }
        // Check if the collection is empty
        $noResults = $imageDatas->isEmpty();

        // Prepare the data for the view
        $data = compact('leftdata', 'rightdata', 'userId', 'imageDatas', 'search', 'noResults');

        // Pass the data to the view
        return view('calculator')->with($data);
    }




    public function destroyleft($id)
    {
        $item = LeftSelectedCard::find($id);
        if ($item) {
            $item->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function destroyright($id)
    {
        $item = RightSelectedCard::find($id);
        if ($item) {
            $item->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
