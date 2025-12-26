<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Data acara yang akan datang (Static data from previous Livewire component)
        $upcomingEvents = [
            [
                'title' => 'Workshop Laravel & Livewire',
                'date' => 'Sabtu, 28 Des 2024 • 14:00 WIB',
                'location' => 'Jakarta Convention Center',
                'description' => 'Belajar membangun aplikasi web modern dengan Laravel dan Livewire dari dasar hingga mahir',
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400&h=200&fit=crop',
                'attendees' => 45,
            ],
            [
                'title' => 'Meetup Developer Indonesia',
                'date' => 'Minggu, 29 Des 2024 • 10:00 WIB',
                'location' => 'Bandung Digital Valley',
                'description' => 'Networking dan sharing session dengan developer se-Indonesia, diskusi teknologi terkini',
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400&h=200&fit=crop',
                'attendees' => 120,
            ],
            [
                'title' => 'Seminar Web Development 2024',
                'date' => 'Senin, 30 Des 2024 • 13:00 WIB',
                'location' => 'Online via Zoom',
                'description' => 'Tren dan teknologi web development terkini di tahun 2024, best practices dan tips',
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400&h=200&fit=crop',
                'attendees' => 200,
            ],
            [
                'title' => 'Hackathon 48 Jam',
                'date' => 'Jum, 3 Jan 2025 • 09:00 WIB',
                'location' => 'Surabaya Tech Hub',
                'description' => 'Kompetisi coding 48 jam dengan hadiah total 50 juta rupiah untuk pemenang',
                'image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=400&h=200&fit=crop',
                'attendees' => 80,
            ],
            [
                'title' => 'Pelatihan UI/UX Design',
                'date' => 'Sab, 4 Jan 2025 • 15:00 WIB',
                'location' => 'Yogyakarta Creative Hub',
                'description' => 'Workshop intensif desain antarmuka dan pengalaman pengguna untuk pemula',
                'image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=400&h=200&fit=crop',
                'attendees' => 60,
            ],
            [
                'title' => 'Tech Talk: AI & Machine Learning',
                'date' => 'Rab, 8 Jan 2025 • 19:00 WIB',
                'location' => 'Online via Google Meet',
                'description' => 'Diskusi mendalam tentang implementasi AI dan Machine Learning dalam aplikasi web',
                'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=400&h=200&fit=crop',
                'attendees' => 150,
            ],
        ];

        // Data acara yang sudah lewat
        $pastEvents = [
            [
                'title' => 'Konferensi PHP Indonesia 2024',
                'date' => 'Sab, 15 Des 2024 • 09:00 WIB',
                'location' => 'Jakarta International Expo',
                'description' => 'Konferensi tahunan komunitas PHP Indonesia dengan pembicara internasional',
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400&h=200&fit=crop',
                'attendees' => 300,
            ],
            [
                'title' => 'Workshop Git & GitHub',
                'date' => 'Min, 10 Des 2024 • 13:00 WIB',
                'location' => 'Semarang Coworking Space',
                'description' => 'Belajar version control dengan Git dan kolaborasi di GitHub untuk tim',
                'image' => 'https://images.unsplash.com/photo-1556075798-4825dfaaf498?w=400&h=200&fit=crop',
                'attendees' => 35,
            ],
            [
                'title' => 'Bootcamp Full Stack Developer',
                'date' => 'Sen, 2 Des 2024 • 10:00 WIB',
                'location' => 'Bali Tech Campus',
                'description' => 'Program intensif 2 minggu menjadi full stack developer profesional',
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400&h=200&fit=crop',
                'attendees' => 25,
            ],
        ];

        return view('events.index', compact('upcomingEvents', 'pastEvents'));
    }
}
