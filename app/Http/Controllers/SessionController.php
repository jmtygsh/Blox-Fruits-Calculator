<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\LeftSelectedCard; // Import your model
use App\Models\RightSelectedCard; // Import your model (assuming this exists)
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; // Import Carbon for date and time operations

class SessionController extends Controller
{
    public function expireSession(Request $request)
    {
        $currentTime = Carbon::now(); // Get the current time using Carbon

        // Process both card types
        $this->processCards(LeftSelectedCard::class, $currentTime);
        $this->processCards(RightSelectedCard::class, $currentTime);

        return redirect()->back();
    }

    private function processCards(string $modelClass, Carbon $currentTime)
    {
        $cards = $modelClass::all();

        // Check if there are no cards
        if ($cards->isEmpty()) {
            Log::info('No users found for ' . $modelClass);
            return redirect()->back();
        }

        foreach ($cards as $card) {
            $updatedAt = $card->updated_at;
            $cardId = $card->user_id;

            // Ensure updated_at is a Carbon instance
            $pastTime = Carbon::parse($updatedAt);
            $diffInHours = $pastTime->diffInHours($currentTime);

            if ($diffInHours >= 2) { // Check if the difference is 2 hours or more
                Log::info($modelClass . ' ID: ' . $cardId . ' - More than 2 hours ago. Time difference: ' . $diffInHours . ' hours.');
                $modelClass::where('user_id', $cardId)->delete();
            } else {
                Log::info($modelClass . ' ID: ' . $cardId . ' - Within the last 2 hours. Time difference: ' . $diffInHours . ' hours.');
            }
        }
    }
}
