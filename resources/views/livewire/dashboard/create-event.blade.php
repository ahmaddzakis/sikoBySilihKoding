<div class="min-h-screen bg-slate-100 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-3">

            {{-- LEFT : EVENT IMAGE --}}
            <div class="bg-gradient-to-br from-sky-500 to-indigo-500 p-6 flex items-center justify-center">
                <div class="w-full aspect-square bg-white/20 rounded-lg flex items-center justify-center text-white text-lg">
                    Event Cover
                </div>
            </div>

            {{-- RIGHT : FORM --}}
            <div class="md:col-span-2 p-8 space-y-6">

                <h1 class="text-2xl font-bold text-slate-800">
                    Create Event
                </h1>

                @if($editingEventId)
                    <form wire:submit.prevent="update">
                @else
                    <form wire:submit.prevent="save">
                @endif

                {{-- EVENT NAME --}}
                <div>
                    <label class="block text-sm font-medium text-slate-600">
                        Event Name
                    </label>
                    <input
                        type="text"
                        wire:model="judul"
                        placeholder="Nama Event"
                        class="mt-1 w-full rounded-lg border-slate-300"
                    >

                </div>

                {{-- DATE & TIME --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-600">
                            Start
                        </label>
                        <input
                            type="datetime-local"
                            wire:model="waktu_mulai"
                            class="mt-1 w-full rounded-lg border-slate-300"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600">
                            End
                        </label>
                        <input
                            type="datetime-local"
                            wire:model="waktu_selesai"
                            class="mt-1 w-full rounded-lg border-slate-300"
                        >
                    </div>
                </div>

                {{-- LOCATION --}}
                <div>
                    <label class="block text-sm font-medium text-slate-600">
                        Location
                    </label>
                    <input
                        type="text"
                        wire:model="lokasi"
                        placeholder="Offline location / Online link"
                        class="mt-1 w-full rounded-lg border-slate-300"
                    >
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="block text-sm font-medium text-slate-600">
                        Description
                    </label>
                    <textarea
                        wire:model="description"
                        rows="4"
                        placeholder="Deskripsi event"
                        class="mt-1 w-full rounded-lg border-slate-300"
                    ></textarea>
                </div>

                {{-- BUTTON --}}
                <div class="pt-4">
                    <button
                        type="submit"
                        class="w-full bg-sky-600 hover:bg-sky-700 text-white font-semibold py-3 rounded-lg transition"
                    >
                        {{ $editingEventId ? 'Update Event' : 'Create Event' }}
                    </button>
                </div>

            </form>

            {{-- LIST OF EVENTS (CRUD) --}}
            <div class="pt-6">
                <h2 class="text-lg font-semibold">My Events</h2>
                @if (session()->has('success'))
                    <div class="text-green-600">{{ session('success') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="text-red-600">{{ session('error') }}</div>
                @endif
                <div class="mt-3 space-y-3">
                    @forelse($events as $e)
                        <div class="p-3 border rounded flex justify-between items-center">
                            <div>
                                <div class="font-medium">{{ $e->judul }}</div>
                                <div class="text-sm text-slate-500">{{ $e->waktu_mulai }} — {{ $e->waktu_selesai }}</div>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click.prevent="edit({{ $e->id }})" class="px-3 py-1 bg-yellow-400 rounded">Edit</button>
                                <button wire:click.prevent="delete({{ $e->id }})" class="px-3 py-1 bg-red-500 text-white rounded">Delete</button>
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-slate-500">Belum ada event.</div>
                    @endforelse
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
