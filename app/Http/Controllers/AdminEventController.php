<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminEventController extends Controller
{
    public function index(Request $request)
    {
        $events = [];
        if (Auth::check()) {
            $query = Event::where('organizer_id', Auth::id());

            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('lokasi', 'like', "%{$search}%");
                });
            }

            $events = $query->orderBy('waktu_mulai', 'desc')->get();
        }
        return view('dashboard.events.index', compact('events'));
    }

    public function create()
    {
        return view('dashboard.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'description' => 'nullable|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Event::create([
            'organizer_id' => Auth::id(),
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'lokasi' => $request->lokasi,
            'description' => $request->description,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return redirect()->route('dashboard.events.index')->with('success', 'Event berhasil dibuat');
    }

    public function edit(Event $event)
    {
        // Return view with edit form
        // Since we are refactoring to blade, we might need a separate edit page or use a modal with JS filling.
        // Simplest is a separate edit page for standard MVC.
        // But to keep it close to the "Single Page" feel without Livewire, maybe a separate page is safer.
        return view('dashboard.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        // Authorization check? Assuming admin/organizer logic is in middleware or similar, 
        // but explicit check is good.
        if ($event->organizer_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'description' => 'nullable|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $event->update($validated);

        return redirect()->route('dashboard.events.index')->with('success', 'Event berhasil diperbarui');
    }

    public function destroy(Event $event)
    {
        if ($event->organizer_id !== Auth::id()) {
            abort(403);
        }
        $event->delete();
        return redirect()->route('dashboard.events.index')->with('success', 'Event berhasil dihapus');
    }
}
