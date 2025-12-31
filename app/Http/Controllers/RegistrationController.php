<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        // 1. Pastikan user login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mendaftar.');
        }

        $user = Auth::user();

        // 2. Cek apakah sudah terdaftar (DINONAKTIFKAN agar bisa daftar berkali-kali)
        /*
        $alreadyRegistered = Registration::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyRegistered) {
            return back()->with('info', 'Anda sudah terdaftar di acara ini.');
        }
        */

        // 3. Cek apakah sudah penuh (stok)
        if ($event->kapasitas && $event->registrations()->count() >= $event->kapasitas) {
            return back()->with('error', 'Maaf, kuota pendaftaran sudah penuh.');
        }

        // 4. Cek apakah acara sudah dimulai/lewat
        if ($event->waktu_mulai->isPast()) {
            return back()->with('error', 'Maaf, acara sudah dimulai atau telah berakhir.');
        }

        // 5. Simpan pendaftaran
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'phone' => 'required|numeric|digits_between:10,15',
        ]);

        // Penyelenggara/Admin selalu otomatis disetujui
        $status = 'approved';

        $registration = Registration::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'status' => $status,
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return redirect()->route('tickets.download', $registration->id)->with('success', 'Pendaftaran berhasil!');
    }

    public function index(Event $event)
    {
        // Hanya organizer yang bisa lihat daftar pendaftar
        if ($event->organizer_id !== Auth::id()) {
            abort(403);
        }

        $registrations = $event->registrations()->with('user')->get();
        return view('dashboard.registrations.index', compact('event', 'registrations'));
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        // Hanya organizer acara yang bisa mengubah status
        if ($registration->event->organizer_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $registration->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function downloadTicket(Registration $registration)
    {
        // Keamanan: Hanya pemilik tiket yang bisa download
        if ($registration->user_id !== Auth::id()) {
            abort(403);
        }

        // Tiket/Bukti bisa didownload langsung setelah daftar (permintaan user)
        /*
        if ($registration->status !== 'approved') {
            return back()->with('error', 'Tiket Anda belum disetujui oleh penyelenggara.');
        }
        */
        return view('ticket', compact('registration'));
    }
}
