<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->query('tab', 'upcoming');

        $upcomingEvents = \App\Models\Event::where('waktu_mulai', '>=', now())
            ->orderBy('waktu_mulai', 'asc')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->judul,
                    'date' => $event->waktu_mulai->translatedFormat('D, d M Y • H:i') . ' WIB',
                    'start_day' => $event->waktu_mulai->format('d'),
                    'start_month' => $event->waktu_mulai->format('M'),
                    'location' => $event->lokasi,
                    'description' => $event->description,
                    'image' => $event->image ? asset('storage/' . $event->image) : null,
                    'organizer' => $event->organizer->name ?? 'Unknown',
                    'price' => $event->harga_tiket,
                    'requires_approval' => $event->requires_approval,
                    'attendees' => $event->registrations()->count(),
                ];
            });

        $pastEvents = \App\Models\Event::where('waktu_mulai', '<', now())
            ->orderBy('waktu_mulai', 'desc')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->judul,
                    'date' => $event->waktu_mulai->translatedFormat('D, d M Y • H:i') . ' WIB',
                    'location' => $event->lokasi,
                    'description' => $event->description,
                    'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400&h=200&fit=crop', // Placeholder
                    'attendees' => $event->registrations()->count(),
                ];
            });

        return view('events', compact('upcomingEvents', 'pastEvents', 'activeTab'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'lokasi' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        \App\Models\Event::create([
            'organizer_id' => auth()->id() ?? 1,
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'description' => $request->description,
            'image' => $imagePath,
            'lokasi' => $request->lokasi,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'harga_tiket' => $request->harga_tiket ?? 0,
            'requires_approval' => $request->has('requires_approval'),
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('home', ['tab' => 'upcoming'])->with('success', 'Acara berhasil dibuat!');
    }

    public function show($id)
    {
        $event = \App\Models\Event::with('organizer')->findOrFail($id);
        return view('event-detail', compact('event'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $events = \App\Models\Event::where('judul', 'like', "%{$query}%")
            ->orWhere('lokasi', 'like', "%{$query}%")
            ->take(5)
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->judul,
                    'date' => $event->waktu_mulai->translatedFormat('d M Y'),
                    'location' => $event->lokasi,
                    'image' => $event->image ? asset('storage/' . $event->image) : null,
                ];
            });

        return response()->json($events);
    }
}
