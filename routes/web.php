<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BloxController;
use App\Http\Controllers\HandleFruitsCard;
use App\Http\Controllers\TradeController;
use App\Http\Middleware\UserIdMiddleware;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ChatController;


Route::get('/', function () { return view('index'); })->name('/');

Route::get('/calculator', [BloxController::class, 'index'])->name('calculator');

Route::get('/trade', [TradeController::class, 'trade'])->name('trade');


Route::get('/privacy-policy', function () { return view('privacy'); })->name('privacy');
Route::get('/about', function () { return view('about'); })->name('about-contact');
Route::get('/disclaimer', function () { return view('disclaimer'); })->name('disclaimer');

Route::post('/like-home', [LikeController::class, 'like']);

Route::post('/unlike-home', [LikeController::class, 'unlike']);


Route::get('/dashboard', [TradeController::class, 'Dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


// Profile routes with 'auth' middleware
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post('/trade/left', [TradeController::class, 'Left'])->name('trade.left');
    Route::post('/trade/right', [TradeController::class, 'Right'])->name('trade.right');

    // Routes for deleting trade left and right items
    Route::delete('/delete/trade/left/{id}', [TradeController::class, 'DestroyLeft'])->name('delete-trade-left');
    Route::delete('/delete/trade/right/{id}', [TradeController::class, 'DestroyRight'])->name('delete-trade-right');
    Route::post('/trade/submit', [TradeController::class, 'Submit'])->name('trade.submit');



    Route::get('/old/trade', [TradeController::class, 'OldTrade'])->name('old.trade');
    Route::post('/old/trade/{id}', [TradeController::class, 'deleteOldTrade'])->name('trade.delete');

    Route::get('/old/trade/{batchid}/{id}/edit', [TradeController::class, 'edit'])->name('trade.edit');
    Route::put('/old/trade/{batchid}/{id}/update', [TradeController::class, 'update'])->name('trade.update');


    Route::get('/comments/{tradeId}', [TradeController::class, 'IndComment'])->name('comments.ind');
    Route::post('/comments/{tradeId}', [TradeController::class, 'storeComment'])->name('comments.store');
});

// Authentication routes
require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';



// Routes for handling fruits card actions with 'UserIdMiddleware'
Route::middleware([UserIdMiddleware::class])->group(function () {
    Route::post('/fruits/left', [HandleFruitsCard::class, 'left'])->name('left-card-select');
    Route::post('/fruits/right', [HandleFruitsCard::class, 'right'])->name('right-card-select');
});

// Routes for deleting left and right items
Route::delete('/delete/left/{id}', [BloxController::class, 'destroyLeft'])->name('delete-left-item');
Route::delete('/delete/right/{id}', [BloxController::class, 'destroyRight'])->name('delete-right-item');



Route::get('/chat/{id}', [ChatController::class, 'chatID'])->middleware(['auth', 'verified'])->name('chat-id');
Route::post('/messages/{id}', [ChatController::class, 'messages'])->middleware(['auth', 'verified'])->name('chat.messages');
Route::get('/chat-dashboard', [ChatController::class, 'chatDashboard'])->middleware(['auth', 'verified'])->name('chat.dashboard');
Route::post('/chat/filter', [ChatController::class, 'chatFilter'])->name('chat.filter');
