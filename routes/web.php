<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\ProfileController;

// ================== AUTH ==================
// ================== GUEST MIDDLEWARE ==================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::get('/admin/login', [AuthController::class, 'adminLoginForm'])->name('admin.login');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

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
});

// ================== PUBLIC ROUTES ==================

    // ================== MAIN APP (Previously Public) ==================
    Route::get('/', function () {
        if (auth()->check()) {
            return auth()->user()->role === 'admin' 
                ? redirect()->route('dashboard') 
                : redirect()->route('home');
        }
        return redirect()->route('home'); // Redirect guests to home instead of login
    });

    // HOME & EVENTS (Public Access)
    Route::get('/home', [EventController::class, 'index'])->name('home');

    Route::get('/events', function (Request $request) {
        return redirect()->route('home', ['tab' => $request->query('tab', 'upcoming')]);
    })->name('events.index');

    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

    Route::get('/calendar', function () {
        return view('calendar');
    })->name('calendar')->middleware('auth'); // Keep calendar protected? Usually personal.

    Route::get('/calendar/my-events', function () {
        $events = Auth::user()->events()->withCount('registrations')->orderBy('waktu_mulai')->get();
        return view('my-events', compact('events'));
    })->name('calendar.my-events')->middleware('auth');

    Route::get('/help', function () {
        return view('help');
    })->name('help');

    // ================== REGISTRATION & TICKETS (Protected) ==================
Route::middleware('auth')->group(function () {
    Route::post('/events/{event}/register', [\App\Http\Controllers\RegistrationController::class, 'store'])->name('events.register');
    Route::get('/tickets/{registration}/download', [\App\Http\Controllers\RegistrationController::class, 'downloadTicket'])->name('tickets.download');

    // Management (Organizer)
    Route::get('/dashboard/registrations/{event}', [\App\Http\Controllers\RegistrationController::class, 'index'])->name('dashboard.registrations.index');
    Route::patch('/dashboard/registrations/{registration}/status', [\App\Http\Controllers\RegistrationController::class, 'updateStatus'])->name('dashboard.registrations.status');

    // ================== CREATE & EDIT EVENT ==================
    Route::get('/create', [EventController::class, 'create'])->name('create');
    Route::post('/create', [EventController::class, 'store'])->name('event.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
}); // End of Protected Event Management

// ================== DISCOVERY (Public) ==================

    Route::get('/find', [EventController::class, 'discover'])->name('find');

    Route::get('/search', [EventController::class, 'search'])->name('events.search');

    Route::get('/find/city/{city}', [EventController::class, 'city'])->name('find.city');

    Route::get('/find/{category}', [EventController::class, 'category'])->name('find.category');
    Route::get('/find/{category}', [EventController::class, 'category'])->name('find.category');
// End of file cleanup (removed trailing closure from original file)

// ================== SIGN IN (LEGACY) ==================
// Kept for backward compatibility, though /login is the main auth route.
Route::get('/signin', function () {
    return redirect()->route('login');
})->name('signin');

// Deprecated POST route - redirect to login in case of cached forms
Route::post('/signin', function () {
    return redirect()->route('login');
})->name('signin.post');

