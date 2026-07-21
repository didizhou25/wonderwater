<?php

use App\Http\Controllers\WaitlistSignupController;
use App\Models\WaitlistSignup;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('coming-soon', [
        'signupCount' => WaitlistSignup::count(),
    ]);
})->name('coming-soon');

Route::get('/preview', function () {
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

Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['nl', 'en'], true)) {
        session(['locale' => $locale]);
    }

    return back();
})->name('lang.switch');
