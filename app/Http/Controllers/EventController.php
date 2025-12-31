<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->query('tab', 'upcoming');

        $upcomingEvents = \App\Models\Event::where('organizer_id', auth()->id())
            ->where('waktu_selesai', '>=', now())
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

        $pastEvents = \App\Models\Event::where('organizer_id', auth()->id())
            ->where('waktu_selesai', '<', now())
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
        $visibilities = \App\Models\EventVisibility::where('slug', 'private')->get();
        return view('create', compact('categories', 'visibilities'));
    }

    public function store(Request $request)
    {
        \Log::info('Event store request received', $request->all());

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
            // Default images mapping
            $defaultImages = [
                1 => 'teknologi.jpg', // Teknologi
                2 => 'makanan.jpg',   // Makanan
                3 => 'musik.jpg',     // Musik
                4 => 'seni.jpg',      // Seni
                5 => 'kesehatan.jpg', // Kesehatan
                6 => 'ai.jpg',        // Ai
                7 => 'iklim.jpg',     // Iklim
                8 => 'kebugaran.jpg', // Kebugaran
                9 => 'lainnya.jpg',   // Lainnya
            ];

            // Get default image based on category, fallback to 'lainnya.jpg' if not found
            $defaultImageName = $defaultImages[$request->category_id] ?? 'lainnya.jpg';
            $imagePath = 'events/defaults/' . $defaultImageName;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('events', 'public');
            }

            $event = \App\Models\Event::create([
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

            \Log::info('Event created successfully', ['id' => $event->id]);

            return redirect()->route('home', ['tab' => 'upcoming'])->with('success', 'Acara berhasil dibuat!');
        } catch (\Exception $e) {
            \Log::error('Error saving event: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan acara: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $event = \App\Models\Event::findOrFail($id);

        // Authorization: Only organizer can edit
        if ($event->organizer_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit acara ini.');
        }

        $categories = \App\Models\Category::all();
        $visibilities = \App\Models\EventVisibility::where('slug', 'private')->get();

        return view('edit', compact('event', 'categories', 'visibilities'));
    }

    public function update(Request $request, $id)
    {
        $event = \App\Models\Event::findOrFail($id);

        // Authorization: Only organizer can update
        if ($event->organizer_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah acara ini.');
        }

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
            $imagePath = $event->image;
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($event->image && \Storage::disk('public')->exists($event->image)) {
                    \Storage::disk('public')->delete($event->image);
                }
                $imagePath = $request->file('image')->store('events', 'public');
            }

            $event->update([
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

            \Log::info('Event updated successfully', ['id' => $event->id]);

            return redirect()->route('events.show', $event->id)->with('success', 'Acara berhasil diperbarui!');
        } catch (\Exception $e) {
            \Log::error('Error updating event: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->withErrors(['error' => 'Gagal memperbarui acara: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $event = \App\Models\Event::findOrFail($id);

        // Authorization: Only organizer can delete
        if ($event->organizer_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus acara ini.');
        }

        try {
            // Delete image if exists
            if ($event->image && \Storage::disk('public')->exists($event->image)) {
                \Storage::disk('public')->delete($event->image);
            }

            $event->delete();

            \Log::info('Event deleted successfully', ['id' => $id]);

            return redirect()->route('home')->with('success', 'Acara berhasil dihapus!');
        } catch (\Exception $e) {
            \Log::error('Error deleting event: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withErrors(['error' => 'Gagal menghapus acara: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $event = \App\Models\Event::visible()->with('organizer')->findOrFail($id);
        
        $existingRegistration = null;
        if (\Auth::check()) {
            $existingRegistration = $event->registrations()
                ->where('user_id', \Auth::id())
                ->first();
        }

        return view('event-detail', compact('event', 'existingRegistration'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $events = \App\Models\Event::visible()->where(function ($q) use ($query) {
            $q->where('judul', 'like', "%{$query}%")
                ->orWhere('lokasi', 'like', "%{$query}%");
        })
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
    public function category($name)
    {
        $category = \App\Models\Category::where('nama', 'like', $name)->first();
        if (!$category) {
            $category = \App\Models\Category::where('nama', 'ilike', $name)->first();
        }

        if (!$category) {
            abort(404);
        }

        $events = $category->events()->visible()
            ->where('waktu_mulai', '>=', now())
            ->orderBy('waktu_mulai')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->judul,
                    'date' => $event->waktu_mulai->format('j/n'),
                    'location' => $event->lokasi,
                    'image' => $event->image ? asset('storage/' . $event->image) : null,
                    'month_name' => $event->waktu_mulai->translatedFormat('F'),
                ];
            });

        return view('category', [
            'category' => $category->nama,
            'description' => $category->deskripsi,
            'events' => $events,
            'eventCount' => $category->events()->visible()->count(),
        ]);
    }

    public function city($city)
    {
        $events = \App\Models\Event::visible()->where('lokasi', 'like', '%' . $city . '%')
            ->where('waktu_mulai', '>=', now())
            ->orderBy('waktu_mulai')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->judul,
                    'date' => $event->waktu_mulai->translatedFormat('l, d F'),
                    'time' => $event->waktu_mulai->format('H.i'),
                    'location' => $event->lokasi,
                    'image' => $event->image ? asset('storage/' . $event->image) : null,
                    'organizer' => $event->organizer->name,
                ];
            });

    }

    public function discover()
    {
        // Ambil acara yang dibuat oleh admin (role: admin)
        $events = \App\Models\Event::whereHas('organizer', function ($query) {
            $query->where('role', 'admin');
        })->where('waktu_mulai', '>=', now())
            ->orderBy('waktu_mulai')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->judul,
                    'date' => $event->waktu_mulai->translatedFormat('D, d M Y • H:i') . ' WIB',
                    'location' => $event->lokasi,
                    'image' => $event->image ? asset('storage/' . $event->image) : null,
                    'organizer' => $event->organizer->name,
                    'price' => $event->harga_tiket,
                ];
            });

        return view('find', compact('events'));
    }
}

