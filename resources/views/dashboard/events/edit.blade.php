@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-100 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-3">

            {{-- LEFT : EVENT IMAGE --}}
            <div class="bg-gradient-to-br from-purple-500 to-pink-500 p-6 flex items-center justify-center">
                <div class="w-full aspect-square bg-white/20 rounded-lg flex items-center justify-center text-white text-lg">
                    Edit Cover
                </div>
            </div>

            {{-- RIGHT : FORM --}}
            <div class="md:col-span-2 p-8 space-y-6">

                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-slate-800">
                        Edit Event
                    </h1>
                    <a href="{{ route('dashboard.events.index') }}" class="text-sm text-slate-500 hover:text-slate-800">Back onto list</a>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('dashboard.events.update', $event->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- EVENT NAME --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-600">
                            Event Name
                        </label>
                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul', $event->judul) }}"
                            placeholder="Nama Event"
                            class="mt-1 w-full rounded-lg border-slate-300"
                            required
                        >
                    </div>

                    {{-- DATE & TIME --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-600">
                                Start
                            </label>
                            <input
                                type="datetime-local"
                                name="waktu_mulai"
                                value="{{ old('waktu_mulai', $event->waktu_mulai) }}"
                                class="mt-1 w-full rounded-lg border-slate-300"
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-600">
                                End
                            </label>
                            <input
                                type="datetime-local"
                                name="waktu_selesai"
                                value="{{ old('waktu_selesai', $event->waktu_selesai) }}"
                                class="mt-1 w-full rounded-lg border-slate-300"
                                required
                            >
                        </div>
                    </div>

                    {{-- LOCATION --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-2">
                            Location <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                name="lokasi" 
                                id="lokasi-input"
                                value="{{ old('lokasi', $event->lokasi) }}"
                                placeholder="Lokasi atau jalan"
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                                required
                                autocomplete="off"
                            >
                            <button type="button" id="toggle-map" class="absolute right-3 top-3 text-slate-400 hover:text-sky-600">
                                <i class="fa-solid fa-map-location-dot"></i>
                            </button>
                            <!-- Suggestions Dropdown -->
                            <div id="suggestions" class="absolute z-50 w-full bg-white border border-slate-300 rounded-lg shadow-lg mt-1 hidden max-h-60 overflow-y-auto"></div>
                        </div>
                        <div id="map-container" class="hidden mt-2 border border-slate-300 rounded-lg overflow-hidden">
                            <div id="map" class="h-64 w-full z-0"></div>
                            <p class="text-xs text-slate-500 p-2 bg-slate-50">Klik pada peta untuk memilih lokasi</p>
                        </div>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-600">
                            Description
                        </label>
                        <textarea
                            name="description"
                            rows="4"
                            placeholder="Deskripsi event"
                            class="mt-1 w-full rounded-lg border-slate-300"
                        >{{ old('description', $event->description) }}</textarea>
                    </div>

                    {{-- CATEGORY --}}
                     <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-600">
                            Category ID (Optional)
                        </label>
                        <input
                            type="number"
                            name="category_id"
                            value="{{ old('category_id', $event->category_id) }}"
                            placeholder="ID Kategori"
                            class="mt-1 w-full rounded-lg border-slate-300"
                        >
                    </div>

                    {{-- BUTTON --}}
                    <div class="pt-6">
                        <button
                            type="submit"
                            class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 rounded-lg transition"
                        >
                            Update Event
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endpush

@push('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('lokasi-input');
            const mapContainer = document.getElementById('map-container');
            const toggleBtn = document.getElementById('toggle-map');
            const suggestionsBox = document.getElementById('suggestions');
            let map = null;
            let marker = null;
            let debounceTimer;

            function initMap() {
                if (map) return;
                
                // Default to Jakarta if no location, or try to geocode the existing value on load?
                // For now, let's just default to Jakarta/Bandung or maintain user's view if possible.
                map = L.map('map').setView([-6.2088, 106.8456], 13);

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                // Click handler
                map.on('click', function(e) {
                    const lat = e.latlng.lat;
                    const lng = e.latlng.lng;

                    if (marker) {
                        marker.setLatLng([lat, lng]);
                    } else {
                        marker = L.marker([lat, lng]).addTo(map);
                    }

                    // Reverse Geocoding
                    input.value = "Mengambil alamat...";
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                        .then(response => response.json())
                        .then(data => {
                            input.value = data.display_name || `${lat}, ${lng}`;
                        })
                        .catch(err => {
                            console.error(err);
                            input.value = `${lat}, ${lng}`;
                        });
                });
            }

            function toggleMap() {
                mapContainer.classList.toggle('hidden');
                if (!mapContainer.classList.contains('hidden')) {
                    // Initialize map if not exists, and invalidate size to fix render issues
                    if (!map) initMap();
                    setTimeout(() => {
                        map.invalidateSize();
                    }, 100);
                }
            }

            input.addEventListener('focus', function() {
                // Optional: open map on focus
                // toggleMap(); 
                // Better to let user click the button or type for suggestions
            });
            
            toggleBtn.addEventListener('click', toggleMap);

            // Autocomplete Logic
            input.addEventListener('input', function() {
                const query = this.value;
                clearTimeout(debounceTimer);

                if (query.length < 3) {
                    suggestionsBox.classList.add('hidden');
                    return;
                }

                debounceTimer = setTimeout(() => {
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=5`)
                        .then(response => response.json())
                        .then(data => {
                            suggestionsBox.innerHTML = '';
                            if (data.length > 0) {
                                suggestionsBox.classList.remove('hidden');
                                data.forEach(item => {
                                    const div = document.createElement('div');
                                    div.className = 'p-3 hover:bg-slate-100 cursor-pointer text-sm text-slate-700 border-b border-slate-100 last:border-0';
                                    div.textContent = item.display_name;
                                    div.onclick = () => {
                                        input.value = item.display_name;
                                        suggestionsBox.classList.add('hidden');
                                        
                                        // Update Map
                                        if (!map) initMap();
                                        
                                        const lat = parseFloat(item.lat);
                                        const lon = parseFloat(item.lon);
                                        
                                        // Show map if hidden
                                        if(mapContainer.classList.contains('hidden')) {
                                            mapContainer.classList.remove('hidden');
                                            setTimeout(() => map.invalidateSize(), 100);
                                        }

                                        map.setView([lat, lon], 16);
                                        
                                        if (marker) {
                                            marker.setLatLng([lat, lon]);
                                        } else {
                                            marker = L.marker([lat, lon]).addTo(map);
                                        }
                                    };
                                    suggestionsBox.appendChild(div);
                                });
                            } else {
                                suggestionsBox.classList.add('hidden');
                            }
                        })
                        .catch(error => console.error('Error fetching suggestions:', error));
                }, 500); // 500ms debounce
            });

            // Hide suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (e.target !== input && e.target !== suggestionsBox) {
                    suggestionsBox.classList.add('hidden');
                }
            });
        });
    </script>
@endpush
