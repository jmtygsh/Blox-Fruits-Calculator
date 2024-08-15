<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LikeController extends Controller
{
    public function like(Request $request) {
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');

        // Get geolocation data
        $client = new Client();
        $response = $client->get("https://ipinfo.io/{$ipAddress}/geo", [
            'headers' => ['Accept' => 'application/json']
        ]);

        $locationData = json_decode($response->getBody(), true);
        $state = $locationData['region'] ?? null;
        $country = $locationData['country'] ?? null;

        // Check if the user has already liked
        $like = Like::firstOrCreate([
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'state' => $state,
            'country' => $country,
        ]);

        return response()->json(['liked' => true, 'likes_count' => Like::count()]);
    }

    public function unlike(Request $request) {
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');

        // Get geolocation data
        $client = new Client();
        $response = $client->get("https://ipinfo.io/{$ipAddress}/geo", [
            'headers' => ['Accept' => 'application/json']
        ]);

        $locationData = json_decode($response->getBody(), true);
        $state = $locationData['region'] ?? null;
        $country = $locationData['country'] ?? null;

        $like = Like::where('ip_address', $ipAddress)
            ->where('user_agent', $userAgent)
            ->where('state', $state)
            ->where('country', $country)
            ->first();

        if ($like) {
            $like->delete();
        }

        return response()->json(['liked' => false, 'likes_count' => Like::count()]);
    }
}
