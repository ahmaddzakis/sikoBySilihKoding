<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvents = Event::count();
        $totalUsers = User::count();

        return view('dashboard.index', compact('totalEvents', 'totalUsers'));
    }
}
