@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-100 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <form action="{{ route('dashboard.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-3">

            {{-- LEFT : EVENT IMAGE --}}
            {{-- LEFT : EVENT IMAGE --}}
            <div class="bg-gray-100 p-6 flex flex-col items-center justify-center border-r border-gray-200">
                <div class="w-full aspect-[4/3] bg-gray-200 rounded-lg overflow-hidden shadow-md mb-4 relative group">
                    <img id="image-preview" src="{{ $event->image_url }}" alt="Event Cover" class="w-full h-full object-cover">
                    
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <p class="text-white font-bold text-sm">Ganti Gambar</p>
                    </div>
                </div>
                
                <label class="block w-full">
                    <span class="sr-only">Choose profile photo</span>
                    <span class="sr-only">Choose profile photo</span>
                    <input type="file" name="image" id="image-input" class="block w-full text-sm text-slate-500
                      file:mr-4 file:py-2 file:px-4
                      file:rounded-full file:border-0
                      file:text-sm file:font-semibold
                      file:bg-violet-50 file:text-violet-700
                      hover:file:bg-violet-100
                    "/>
                </label>
                <p class="text-xs text-red-500 mt-2 italic">* Biarkan kosong jika tidak ingin mengubah gambar</p>
            </div>

            {{-- RIGHT : FORM --}}
            <div class="md:col-span-2 p-8 space-y-6">

                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-black">
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



                    {{-- EVENT NAME --}}
                    <div>
                        <label class="block text-sm font-bold text-black mb-1">
                            Event Name
                        </label>
                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul', $event->judul) }}"
                            placeholder="Nama Event"
                            class="mt-1 w-full rounded-lg border-slate-300 text-black font-medium"
                            required
                        >
                    </div>

                    {{-- DATE & TIME --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-bold text-black mb-1">
                                Start
                            </label>
                            <input
                                type="datetime-local"
                                name="waktu_mulai"
                                name="waktu_mulai"
                                value="{{ old('waktu_mulai', $event->waktu_mulai) }}"
                                class="mt-1 w-full rounded-lg border-slate-300 text-black font-medium"
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-black mb-1">
                                End
                            </label>
                            <input
                                type="datetime-local"
                                name="waktu_selesai"
                                value="{{ old('waktu_selesai', $event->waktu_selesai) }}"
                                class="mt-1 w-full rounded-lg border-slate-300 text-black font-medium"
                                required
                            >
                        </div>
                    </div>

                    {{-- LOCATION --}}
                    <div>
                        <label class="block text-sm font-bold text-black mb-2">
                            Location <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                name="lokasi" 
                                id="lokasi-input"
                                value="{{ old('lokasi', $event->lokasi) }}"
                                placeholder="Lokasi atau jalan"
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-black font-medium"
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
                        <label class="block text-sm font-bold text-black mb-1">
                            Description
                        </label>
                        <textarea
                            name="description"
                            rows="4"
                            placeholder="Deskripsi event"
                            class="mt-1 w-full rounded-lg border-slate-300 text-black font-medium"
                        >{{ old('description', $event->description) }}</textarea>
                    </div>

                    {{-- VISIBILITY --}}
                    <div class="mt-4">
                        <label class="block text-sm font-bold text-black mb-1">
                            Visibility <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="visibility_id"
                            class="mt-1 w-full rounded-lg border-slate-300 text-black font-medium"
                            required
                        >
                            @foreach($visibilities as $visibility)
                                <option value="{{ $visibility->id }}" {{ old('visibility_id', $event->visibility_id) == $visibility->id ? 'selected' : '' }}>
                                    {{ ucfirst($visibility->nama) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- CATEGORY --}}
                     <div class="mt-4">
                        <label class="block text-sm font-bold text-black mb-1">
                            Category ID (Optional)
                        </label>
                        <select
                            name="category_id"
                            class="mt-1 w-full rounded-lg border-slate-300 text-black font-medium"
                        >
                           <option value="">-- Pilih Kategori --</option>
                           @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama }}
                                </option>
                           @endforeach
                        </select>
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


            </div>
        </div>
        </form>
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
            // Image Preview Logic
            const imageInput = document.getElementById('image-input');
            const imagePreview = document.getElementById('image-preview');
            const placeholderIcon = document.getElementById('placeholder-icon');

            if (imageInput) {
                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imagePreview.classList.remove('hidden');
                            if (placeholderIcon) placeholderIcon.classList.add('hidden');
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

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
