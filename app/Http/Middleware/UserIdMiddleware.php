<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\LeftSelectedCard;
use App\Models\RightSelectedCard;

class UserIdMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if user_id is already in session
        if (!Session::has('user_id')) {
            // Generate a new UUID and store it in the session
            Session::put('user_id', (string) Str::uuid());
        }

        return $next($request);
    }
}
