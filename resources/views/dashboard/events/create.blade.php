@extends('layouts.admin')

@section('title', 'Buat Acara')

@section('content')
<div class="min-h-screen bg-[#1a161f] p-8 -m-8">
    <div class="max-w-4xl mx-auto bg-[#26212c] rounded-xl shadow-lg overflow-hidden p-8 border border-[#3a3442]">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white">Buat Acara Baru</h1>
            <a href="{{ route('dashboard.events.index') }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                Kembali ke Daftar
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 text-red-500 px-4 py-3 rounded-lg relative mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nama Acara -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Nama Acara <span class="text-pink-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="judul" 
                    value="{{ old('judul') }}"
                    placeholder="Masukkan nama acara"
                    class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 placeholder-gray-600 transition-colors"
                    required
                >
            </div>

            <!-- Kategori dan Visibilitas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Kategori <span class="text-pink-500">*</span>
                    </label>
                    <div class="relative">
                        <select 
                            name="category_id" 
                            class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 appearance-none cursor-pointer transition-colors"
                            required
                        >
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->nama }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Visibilitas <span class="text-pink-500">*</span>
                    </label>
                    <div class="relative">
                        <select 
                            name="visibility_id" 
                            class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 appearance-none cursor-pointer transition-colors"
                            required
                        >
                            <option value="">Pilih Visibilitas</option>
                            @foreach($visibilities as $visibility)
                                <option value="{{ $visibility->id }}" {{ old('visibility_id') == $visibility->id ? 'selected' : '' }}>{{ $visibility->nama }}</option>
                            @endforeach
                        </select>
                         <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Waktu Mulai dan Selesai -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Waktu Mulai <span class="text-pink-500">*</span>
                    </label>
                    <input 
                        type="datetime-local" 
                        name="waktu_mulai" 
                        id="waktu_mulai"
                        value="{{ old('waktu_mulai') }}"
                        class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 placeholder-gray-600 transition-colors [color-scheme:dark]"
                        required
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Waktu Selesai <span class="text-pink-500">*</span>
                    </label>
                    <input 
                        type="datetime-local" 
                        name="waktu_selesai" 
                        id="waktu_selesai"
                        value="{{ old('waktu_selesai') }}"
                        class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 placeholder-gray-600 transition-colors [color-scheme:dark]"
                        required
                    >
                </div>
            </div>

            <!-- Lokasi -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Lokasi <span class="text-pink-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="text" 
                        name="lokasi" 
                        id="lokasi-input"
                        value="{{ old('lokasi') }}"
                        placeholder="Lokasi atau jalan"
                        class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 placeholder-gray-600 transition-colors"
                        required
                        autocomplete="off"
                    >
                    <button type="button" id="toggle-map" class="absolute right-3 top-3 text-gray-500 hover:text-pink-500 transition-colors">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </button>
                    <!-- Suggestions Dropdown -->
                    <div id="suggestions" class="absolute z-50 w-full bg-[#1a161f] border border-[#3a3442] rounded-lg shadow-xl mt-1 hidden max-h-60 overflow-y-auto custom-scrollbar"></div>
                </div>
                <div id="map-container" class="hidden mt-2 border border-[#3a3442] rounded-lg overflow-hidden">
                    <div id="map" class="h-64 w-full z-0 grayscale invert brightness-75 contrast-125"></div>
                    <p class="text-xs text-gray-500 p-2 bg-[#1a161f]">Klik pada peta untuk memilih lokasi</p>
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Deskripsi
                </label>
                <textarea 
                    name="description" 
                    rows="5"
                    placeholder="Masukkan deskripsi acara..."
                    class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 placeholder-gray-600 transition-colors"
                >{{ old('description') }}</textarea>
            </div>

            <!-- Upload Gambar -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Gambar Acara
                </label>
                <input 
                    type="file" 
                    name="image" 
                    id="image-input"
                    accept="image/*"
                    class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-500/10 file:text-pink-500 hover:file:bg-pink-500/20 transition-colors"
                >
                <div class="mt-4 relative w-full h-64 bg-[#1a161f] rounded-lg overflow-hidden group border border-[#3a3442]">
                    <img id="image-preview" src="{{ asset('storage/events/default.jpg') }}" alt="Event Preview" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-white font-medium">Preview Gambar</span>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, JPEG (Max: 2MB). Jika dikosongkan akan menggunakan gambar default.</p>
            </div>

            <!-- Opsi Acara -->
            <div class="border-t border-[#3a3442] pt-6 mt-6">
                <h3 class="text-lg font-bold text-white mb-4">Opsi Acara</h3>
                
                <div class="space-y-4">
                    <!-- Harga Tiket -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Harga Tiket (Rp)
                        </label>
                        <input 
                            type="number" 
                            name="harga_tiket" 
                            value="{{ old('harga_tiket', 0) }}"
                            min="0"
                            placeholder="0 untuk gratis"
                            class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 placeholder-gray-600 transition-colors"
                        >
                        <p class="text-xs text-gray-500 mt-1">Kosongkan atau isi 0 untuk acara gratis</p>
                    </div>

                    <!-- Kapasitas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Kapasitas Maksimal
                        </label>
                        <input 
                            type="number" 
                            name="kapasitas" 
                            value="{{ old('kapasitas') }}"
                            min="1"
                            max="100000"
                            placeholder="Kosongkan untuk tidak terbatas"
                            class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 placeholder-gray-600 transition-colors"
                        >
                        <p class="text-xs text-gray-500 mt-1">Kosongkan untuk kapasitas tidak terbatas</p>
                    </div>

                    <!-- Memerlukan Persetujuan -->
                    <div class="flex items-center gap-3">
                        <input 
                            type="checkbox" 
                            name="requires_approval" 
                            id="requires_approval"
                            value="1"
                            {{ old('requires_approval') ? 'checked' : '' }}
                            class="w-5 h-5 text-pink-600 bg-[#1a161f] border-gray-600 rounded focus:ring-pink-500 focus:ring-offset-[#1a161f]"
                        >
                        <label for="requires_approval" class="text-sm font-medium text-gray-300">
                            Memerlukan persetujuan admin untuk pendaftaran
                        </label>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="flex gap-3 pt-6">
                <button 
                    type="submit"
                    class="flex-1 bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-500 hover:to-purple-500 text-white font-bold py-3 px-6 rounded-lg transition-all shadow-lg hover:shadow-pink-500/25"
                >
                    <i class="fa-solid fa-plus mr-2"></i>
                    Buat Acara
                </button>
                <a 
                    href="{{ route('dashboard.events.index') }}"
                    class="px-6 py-3 bg-[#3a3442] hover:bg-[#4d4554] text-gray-200 font-medium rounded-lg transition-all"
                >
                    Batal
                </a>
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
            // Date Validation
            // Date Validation & Defaults
            const now = new Date();
            
            // Helper to format date for datetime-local input (YYYY-MM-DDTHH:mm)
            const toLocalISOString = (date) => {
                const pad = (n) => n.toString().padStart(2, '0');
                const year = date.getFullYear();
                const month = pad(date.getMonth() + 1);
                const day = pad(date.getDate());
                const hours = pad(date.getHours());
                const minutes = pad(date.getMinutes());
                return `${year}-${month}-${day}T${hours}:${minutes}`;
            };

            const minDateTime = toLocalISOString(now);
            
            const waktuMulai = document.getElementById('waktu_mulai');
            const waktuSelesai = document.getElementById('waktu_selesai');

            // Set restriction to prevent past dates
            waktuMulai.min = minDateTime;
            waktuSelesai.min = minDateTime;

            // Set Default Values if empty (Next Hour)
            if (!waktuMulai.value) {
                const startTime = new Date();
                startTime.setHours(startTime.getHours() + 1);
                startTime.setMinutes(0, 0, 0); // Start exact at next hour
                
                const endTime = new Date(startTime);
                endTime.setHours(endTime.getHours() + 1);

                waktuMulai.value = toLocalISOString(startTime);
                waktuSelesai.value = toLocalISOString(endTime);
                
                // Ensure end time min is valid
                waktuSelesai.min = waktuMulai.value;
            }

            waktuMulai.addEventListener('change', function() {
                waktuSelesai.min = this.value;
                if (waktuSelesai.value && waktuSelesai.value < this.value) {
                    waktuSelesai.value = this.value;
                }
            });

            // Image Preview
            const imageInput = document.getElementById('image-input');
            const imagePreview = document.getElementById('image-preview');

            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                } else {
                    // Revert to default
                     imagePreview.src = "{{ asset('storage/events/default.jpg') }}";
                }
            });

            const input = document.getElementById('lokasi-input');
            const mapContainer = document.getElementById('map-container');
            const toggleBtn = document.getElementById('toggle-map');
            let map = null;
            let marker = null;
    
            function initMap() {
                if (map) return;
                
                // Default to Jakarta/Bandung or generic Indonesia coords if no location
                // Using a generic Jakarta coordinate: -6.2088, 106.8456
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
    
            toggleBtn.addEventListener('click', toggleMap);

            input.addEventListener('focus', function() {
               // Optional: open map on focus or just show suggestions
               // toggleMap(); 
            });
    
            // Autocomplete Logic
            const suggestionsBox = document.getElementById('suggestions');
            let debounceTimer;
    
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