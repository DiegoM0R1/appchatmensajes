<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/chat/messages/{userId}', [ChatController::class, 'getMessages'])->name('chat.messages');
Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');});

require __DIR__.'/auth.php';
