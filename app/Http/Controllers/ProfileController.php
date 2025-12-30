<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', [
            'user' => $user,
            'createdEventsCount' => \App\Models\Event::where('organizer_id', $user->id)->count(),
            'registrations' => \App\Models\Registration::with('event')
                ->where('user_id', $user->id)
                ->get(),
        ]);
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.mimes' => 'Format gambar yang diperbolehkan hanya jpeg, png, jpg, gif, atau svg.',
            'avatar.max' => 'Ukuran gambar tidak boleh melebihi 2MB.',
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
            $user->save();

            return back()->with('success', 'Foto profil berhasil diperbarui!');
        }

        return back()->with('error', 'Gagal memuat file gambar.');
    }

    public function deleteAvatar()
    {
        $user = Auth::user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = null;
            $user->save();

            return back()->with('success', 'Foto profil berhasil dihapus.');
        }

        return back()->with('info', 'Anda tidak memiliki foto profil untuk dihapus.');
    }
}
