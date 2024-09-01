<?php

use App\Events\ExampleEvent;
use App\Events\OrderDelivered;
use App\Events\OrderDispatched;
use App\Http\Controllers\ProfileController;
use App\Models\Message;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/broadcast', function () {
    broadcast(new OrderDispatched(User::find(2), Order::find(1)));
    sleep(5);
    broadcast(new OrderDelivered(User::find(2), Order::find(1)));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
