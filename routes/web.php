<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\ProfileController;

// ================== AUTH ==================
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/admin/login', [AuthController::class, 'adminLoginForm'])->name('admin.login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================== PROTECTED ROUTES ==================
Route::middleware('auth')->group(function () {
    // ================== DASHBOARD ==================
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('dashboard/events', AdminEventController::class)->names('dashboard.events');
        Route::resource('dashboard/users', \App\Http\Controllers\AdminUserController::class)->names('dashboard.users');
    });

    // ================== PROFILE ==================
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');

    // ================== MAIN APP (Previously Public) ==================
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('/home', function (Request $request) {
        $activeTab = $request->query('tab', 'upcoming');

        $upcomingEvents = [];
        $pastEvents = [];

        return view('events', [
            'activeTab' => $activeTab,
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents,
        ]);
    })->name('home');

    Route::get('/events', function (Request $request) {
        return redirect()->route('home', ['tab' => $request->query('tab', 'upcoming')]);
    })->name('events.index');

    Route::get('/calendar', function () {
        return view('calendar');
    })->name('calendar');

    Route::get('/help', function () {
        return view('help');
    })->name('help');

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
});

// ================== SIGN IN (LEGACY) ==================
// Kept for backward compatibility, though /login is the main auth route.
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
