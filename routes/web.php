<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Create;
use Illuminate\Http\Request;

Route::get('/counter', Counter::class);

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

Route::get('/', function () {
    return view('welcome');
});

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
