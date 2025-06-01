<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\JoinForm;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/join', App\Livewire\JoinForm::class)->name('join');

// Redirect /register to /join
Route::get('/register', function () {
    return redirect()->route('join');
})->name('register');

Route::get('/test-flowbite', function () {
    return view('test-flowbite');
});

// Authenticated routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'adjust.session.lifetime',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/home', 'home')->name('home');
    Route::view('/education', 'education')->name('education');
    Route::view('/garden', 'garden')->name('garden');
    Route::view('/library', 'library')->name('library');
    Route::view('/directory', 'directory')->name('directory');
    Route::view('/neighborhood', 'neighborhood')->name('neighborhood');
    Route::view('/wiki', 'wiki')->name('wiki');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/policy', function () {
    return view('policy');
});