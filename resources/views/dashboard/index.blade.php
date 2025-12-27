@extends('layouts.admin')

@section('content')
<div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        {{-- CARD EVENT --}}
        <a href="{{ route('dashboard.events.index') }}" class="block bg-white p-4 rounded shadow hover:bg-slate-50 transition">
            <p class="text-sm text-slate-500">Total Event</p>
            <p class="text-2xl font-bold">{{ $totalEvents }}</p>
        </a>

        {{-- CARD USER --}}
        <a href="{{ route('dashboard.users.index') }}" class="block bg-white p-4 rounded shadow hover:bg-slate-50 transition">
            <p class="text-sm text-slate-500">Total User</p>
            <p class="text-2xl font-bold">{{ $totalUsers }}</p>
        </a>


    </div>
</div>
@endsection
