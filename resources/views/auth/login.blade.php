@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="w-96 p-6 border rounded">
        <h1 class="text-xl font-bold mb-4">Login</h1>

        @if (session()->has('error'))
            <div class="text-red-600 mb-2">
                {{ session('error') }}
            </div>
        @endif

        @error('email')
            <div class="text-red-600 mb-2">
                {{ $message }}
            </div>
        @enderror

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email"
                class="border p-2 w-full mb-2"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                class="border p-2 w-full mb-3"
                required
            >

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 w-full"
            >
                Login
            </button>
        </form>
    </div>
</div>
@endsection
