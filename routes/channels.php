<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chatChannel.{id}', function ( User $user, $id) {
    return (int) $user->id === (int) $id;
});


