<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\Dashboard\CreateEvent;
use App\Livewire\Counter;
use App\Livewire\Events;

// ================== AUTH ==================
Route::get('/login', Login::class)->name('login');

// ================== PUBLIC ==================
Route::get('/', Events::class)->name('home');
Route::get('/counter', Counter::class);
Route::get('/events', Events::class)->name('events');

// ================== DASHBOARD ==================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardIndex::class);

    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard/create-event', CreateEvent::class);
    });
});

// ================== SIGN IN (NON LIVEWIRE) ==================
Route::get('/signin', function () {
    return view('signin');
})->name('signin');

Route::post('/signin', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    return redirect('/');
})->name('signin.post');

// ================== CREATE EVENT ==================
Route::get('/create', function () {
    return view('create');
})->name('create');

Route::post('/create', function (Request $request) {
    $request->validate([
        'title' => 'required|max:255',
    ]);

    return redirect()->back()->with('success', 'Acara berhasil dibuat!');
})->name('event.store');

// ================== FIND ==================
Route::get('/find', function () {
    return view('find');
})->name('find');

Route::get('/find/city/{city}', function ($city) {
    return view('city', compact('city'));
})->name('find.city');

Route::get('/find/{category}', function ($category) {
    return view('category', compact('category'));
})->name('find.category');