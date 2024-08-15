<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ChatController;

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('admin.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');

    Route::post('login', [LoginController::class, 'store']);
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    // Admin routes for image handling
    Route::get('/images', [ImageController::class, 'view'])->name('images.view');
    Route::post('/images', [ImageController::class, 'store'])->name('images.store');
    Route::get('/edit/{id}', [ImageController::class, 'edit'])->name('images.edit');
    Route::put('/update/{id}', [ImageController::class, 'update'])->name('images.update');
    Route::delete('/delete/{id}', [ImageController::class, 'destroy'])->name('images.destroy');

    // Session control route
    Route::post('/end', [SessionController::class, 'expireSession'])->name('flush.session');
    Route::post('/delete/chat', [ChatController::class, 'deleteOldMessages'])->name('chat.delete');
    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
});
