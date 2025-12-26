<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Events;
use App\Livewire\Create;
use Illuminate\Http\Request;

Route::get('/counter', Counter::class);
Route::get('/events', Events::class)->name('events');

// Sign In routes
Route::get('/signin', function () {
    return view('signin');
})->name('signin');

Route::post('/signin', function (Request $request) {
    // TODO: Implement authentication logic
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // Redirect to home page after sign in
    return redirect('/');
})->name('signin.post');

// buat buka halaman create 
Route::get('/create', function () {
    return view('create');
})->name('create');

// Handle saving the event
Route::post('/create', function (Request $request) {
    // Validate the request
    $request->validate([
        'title' => 'required|max:255',
        // TODO: tambahkan validasi untuk field lainnya (start_date, end_date, location, description, dll)
    ]);

    // TODO: Simpan data event ke database
    // Event::create([...]);

    return redirect()->back()->with('success', 'Acara berhasil dibuat!');
})->name('event.store');

Route::get('/', Events::class)->name('home');

// buat buka halaman find 
Route::get('/find', function () {
    return view('find');
})->name('find');

//buka halaman city
Route::get('/find/city/{city}', function ($city) {
    return view('city', ['city' => $city]);
})->name('find.city');

//buka halaman category
Route::get('/find/{category}', function ($category) {
    return view('category', ['category' => $category]);
})->name('find.category');
