<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Category;
use App\Models\EventVisibility;
use App\Models\User;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing events to ensure we only have 5
        Event::query()->delete();

        $categories = Category::all();
        $publicVisibility = EventVisibility::where('slug', 'public')->first();
        $user = User::first();

        if (!$user || !$publicVisibility || $categories->isEmpty()) {
            return;
        }

        $eventsData = [
            [
                'judul' => "Sigit's Birthday!",
                'description' => 'Rayakan momen spesial ulang tahun Sigit! Akan ada makan-makan, games seru, dan doorprize menarik. Jangan lupa datang tepat waktu ya!',
                'lokasi' => 'Jakarta Selatan',
                'harga_tiket' => 0,
                'kapasitas' => 50,
            ],
            [
                'judul' => 'Cirebon Cullinary Festival',
                'description' => 'Jelajahi kekayaan rasa nusantara di Festival Kuliner Cirebon. Tersedia ratusan tenan makanan tradisional dan modern yang siap memanjakan lidah Anda.',
                'lokasi' => 'Alun-alun Kejaksan, Cirebon',
                'harga_tiket' => 25000,
                'kapasitas' => 1000,
            ],
            [
                'judul' => 'JCE Meet Up - Sleman Yogyakarta',
                'description' => 'Temu kangen komunitas Java Code Enthusiast chapter Jogja. Diskusi santai seputar teknologi terbaru dan networking dengan sesama developer.',
                'lokasi' => 'Sleman, Yogyakarta',
                'harga_tiket' => 0,
                'kapasitas' => 100,
            ],
            [
                'judul' => 'Konser Denny Caknan (Bandung 2026)',
                'description' => 'Ambyar bareng di konser spesial Denny Caknan! Siapkan hatimu untuk bernyanyi bersama lagu-lagu hits seperti Kartonyono Medot Janji dan Los Dol.',
                'lokasi' => 'Lapangan Gazibu, Bandung',
                'harga_tiket' => 150000,
                'kapasitas' => 5000,
            ]
        ];

        foreach ($eventsData as $data) {
            $startDate = Carbon::create(2026, rand(1, 12), rand(1, 28))->setHour(rand(8, 20));
            
            Event::create([
                'organizer_id' => $user->id,
                'category_id' => $categories->random()->id,
                'visibility_id' => $publicVisibility->id,
                'judul' => $data['judul'],
                'description' => $data['description'],
                'lokasi' => $data['lokasi'],
                'waktu_mulai' => $startDate,
                'waktu_selesai' => $startDate->copy()->addHours(rand(2, 5)),
                'harga_tiket' => $data['harga_tiket'],
                'requires_approval' => rand(0, 1),
                'kapasitas' => $data['kapasitas'],
            ]);
        }
    }
}
