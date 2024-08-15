<?php

namespace App\Http\Controllers;

use App\Models\LeftSelectedCard;
use App\Models\RightSelectedCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HandleFruitsCard extends Controller
{
    public function Left(Request $request)
    {
        return $this->saveCardSelection($request, 'left');
    }

    public function Right(Request $request)
    {
        return $this->saveCardSelection($request, 'right');
    }

    private function saveCardSelection(Request $request, $side)
    {
        $data = [
            'image' => $request->input('image'),
            'user_id' => Session::get('user_id'),
            'card_id' => $request->input('id'),
            'name' => $request->input('name'),
            'value' => $request->input('normalValue'),
            'p_value' => $request->input('permanentValue'),
            'price' => $request->input('price'),
            'isPermanent' => $request->input('isPermanent') === "1" ? true : false,
        ];

        if ($side === 'right') {
            RightSelectedCard::create($data);
        } else {
            LeftSelectedCard::create($data);
        }

        return redirect()->back();
    }
}
