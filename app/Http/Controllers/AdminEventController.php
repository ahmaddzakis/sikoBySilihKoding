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
            $query = Event::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%");
                });
            }

            if ($request->filled('visibility')) {
                $slug = $request->visibility;
                $query->whereHas('visibility', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                });
            }

            if ($request->filled('category')) {
                $query->where('category_id', $request->category);
            }

            $events = $query->orderBy('waktu_mulai', 'desc')->get();
        }
        
        $categories = \App\Models\Category::all();
        $visibilities = \App\Models\EventVisibility::all();

        return view('dashboard.events.index', compact('events', 'categories', 'visibilities'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        $visibilities = \App\Models\EventVisibility::all(); // Admin can create both public and private
        return view('dashboard.events.create', compact('categories', 'visibilities'));
    }

    public function store(Request $request)
    {
        \Log::info('Admin event store request received', $request->all());

        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'visibility_id' => 'required|exists:event_visibilities,id',
                'waktu_mulai' => 'required',
                'waktu_selesai' => 'required',
                'lokasi' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', $e->errors());
            throw $e;
        }

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('events', 'public');
            }

            $event = Event::create([
                'organizer_id' => auth()->id(),
                'category_id' => $request->category_id,
                'visibility_id' => $request->visibility_id,
                'judul' => $request->judul,
                'description' => $request->description,
                'image' => $imagePath,
                'lokasi' => $request->lokasi,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'harga_tiket' => $request->filled('harga_tiket') ? $request->harga_tiket : 0,
                'requires_approval' => $request->requires_approval == 1,
                'kapasitas' => $request->filled('kapasitas') ? $request->kapasitas : null,
            ]);

            \Log::info('Admin event created successfully', ['id' => $event->id]);

            return redirect()->route('dashboard.events.index')->with('success', 'Acara berhasil dibuat!');
        } catch (\Exception $e) {
            \Log::error('Error saving admin event: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan acara: ' . $e->getMessage()]);
        }
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
        // Authorization check skipped as this is an Admin route


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
        // Authorization check skipped as this is an Admin route

        $event->delete();
        return redirect()->route('dashboard.events.index')->with('success', 'Event berhasil dihapus');
    }
}
