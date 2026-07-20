<?php

use App\Http\Controllers\WaitlistSignupController;
use App\Models\WaitlistSignup;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'signupCount' => WaitlistSignup::count(),
    ]);
})->name('home');

Route::get('/movement', function () {
    return view('movement', [
        'signupCount' => WaitlistSignup::count(),
    ]);
})->name('movement');

Route::post('/movement/join', [WaitlistSignupController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('waitlist.join');
