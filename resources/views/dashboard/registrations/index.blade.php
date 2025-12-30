@extends('layouts.app')

@section('title', 'Daftar Peserta - ' . $event->judul)

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard.events.index') }}"
                                class="text-gray-400 hover:text-white text-sm font-medium">Dashboard</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fa-solid fa-chevron-right text-[10px] text-gray-600 mx-2"></i>
                                <span class="text-gray-500 text-sm font-medium">Peserta</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-black text-white">Daftar Peserta</h1>
                <p class="text-gray-500 mt-1">{{ $event->judul }}</p>
            </div>
            <a href="{{ route('dashboard.events.index') }}"
                class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white text-sm font-bold hover:bg-white/10 transition-all">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <!-- Stats Card -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-[#1a161f] border border-[#3a3442] rounded-2xl p-6">
                <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Total Pendaftar</p>
                <h3 class="text-3xl font-black text-white">{{ $registrations->count() }}</h3>
            </div>
            <div class="bg-[#1a161f] border border-[#3a3442] rounded-2xl p-6">
                <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Disetujui</p>
                <h3 class="text-3xl font-black text-green-500">{{ $registrations->where('status', 'approved')->count() }}
                </h3>
            </div>
            <div class="bg-[#1a161f] border border-[#3a3442] rounded-2xl p-6">
                <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Kapasitas Tersisa</p>
                <h3 class="text-3xl font-black text-pink-500">
                    {{ $event->kapasitas ? $event->kapasitas - $registrations->where('status', 'approved')->count() : '∞' }}
                </h3>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-[#1a161f] border border-[#3a3442] rounded-3xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5 border-b border-[#3a3442]">
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Peserta</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Email</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Waktu Daftar
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">
                                Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#3a3442]">
                        @forelse($registrations as $reg)
                            <tr class="hover:bg-white/2 transition-all">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-500 to-purple-500 flex items-center justify-center text-sm font-bold text-white">
                                            {{ substr($reg->user->name, 0, 1) }}
                                        </div>
                                        <span class="text-white font-bold">{{ $reg->user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-gray-400 text-sm">{{ $reg->user->email }}</td>
                                <td class="px-6 py-5 text-gray-500 text-xs">
                                    {{ $reg->created_at->translatedFormat('d F Y, H:i') }}</td>
                                <td class="px-6 py-5">
                                    <div class="flex justify-center">
                                        @if($reg->status == 'approved')
                                            <span
                                                class="px-3 py-1 rounded-full bg-green-500/10 text-green-500 text-[10px] font-black uppercase tracking-widest border border-green-500/20">
                                                Disetujui
                                            </span>
                                        @elseif($reg->status == 'rejected')
                                            <span
                                                class="px-3 py-1 rounded-full bg-red-500/10 text-red-500 text-[10px] font-black uppercase tracking-widest border border-red-500/20">
                                                Ditolak
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 rounded-full bg-yellow-500/10 text-yellow-500 text-[10px] font-black uppercase tracking-widest border border-yellow-500/20">
                                                Pending
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex justify-end gap-2">
                                        @if($reg->status != 'approved')
                                            <form action="{{ route('dashboard.registrations.status', $reg->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit"
                                                    class="w-8 h-8 rounded-lg bg-green-500/20 text-green-500 hover:bg-green-500 hover:text-white transition-all flex items-center justify-center shadow-lg border border-green-500/30"
                                                    title="Setujui">
                                                    <i class="fa-solid fa-check text-xs"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if($reg->status != 'rejected')
                                            <form action="{{ route('dashboard.registrations.status', $reg->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit"
                                                    class="w-8 h-8 rounded-lg bg-red-500/20 text-red-500 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center shadow-lg border border-red-500/30"
                                                    title="Tolak">
                                                    <i class="fa-solid fa-xmark text-xs"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fa-solid fa-users-slash text-5xl text-gray-700 mb-4"></i>
                                        <p class="text-gray-500 font-bold text-lg">Belum ada peserta yang mendaftar.</p>
                                        <p class="text-gray-600 text-sm">Bagikan acara Anda untuk mendapatkan pendaftar!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection