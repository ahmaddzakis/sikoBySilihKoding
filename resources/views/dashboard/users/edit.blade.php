@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="min-h-screen bg-slate-100 -m-8 p-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden p-8">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Edit Pengguna</h1>
            <a href="{{ route('dashboard.users.index') }}" class="text-sm text-slate-500 hover:text-slate-800">
                Kembali ke Daftar
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name', $user->name) }}"
                    placeholder="Masukkan nama pengguna"
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                    required
                >
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $user->email) }}"
                    placeholder="Masukkan alamat email"
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                    required
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Password Baru
                </label>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Biarkan kosong jika tidak ingin mengubah"
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                >
                <p class="text-xs text-slate-500 mt-1">Isi hanya jika ingin mengubah password.</p>
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Peran (Role) <span class="text-red-500">*</span>
                </label>
                <select 
                    name="role" 
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                    required
                >
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <!-- Tombol Submit -->
            <div class="flex gap-3 pt-6">
                <button 
                    type="submit"
                    class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-6 rounded-lg transition-all shadow-md hover:shadow-lg"
                >
                    <i class="fa-solid fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
                <a 
                    href="{{ route('dashboard.users.index') }}"
                    class="px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition-all"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
