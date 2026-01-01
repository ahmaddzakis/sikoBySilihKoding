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
        $categories = Category::all();
        $publicVisibility = EventVisibility::where('slug', 'public')->first();
        $user = User::first();

        if (!$user || !$publicVisibility || $categories->isEmpty()) {
            return;
        }

        // Fetch Admin and User
        $admin = User::where('email', 'admin@gmail.com')->first();
        $user = User::where('email', 'user@gmail.com')->first() ?? $user; // Fallback to first user if specific user not found

        $eventsData = [
            [
                'judul' => "Sigit's Birthday!",
                'description' => 'Rayakan momen spesial ulang tahun Sigit! Akan ada makan-makan, games seru, dan doorprize menarik. Jangan lupa datang tepat waktu ya!',
                'lokasi' => 'Jl. Kemang Raya No. 12, Pela Mampang, Jakarta Selatan',
                'harga_tiket' => 0,
                'kapasitas' => 50,
                'category_name' => 'Lainnya',
                'organizer_id' => $user->id, // User event
            ],
            [
                'judul' => 'Cirebon Cullinary Festival',
                'description' => 'Jelajahi kekayaan rasa nusantara di Festival Kuliner Cirebon. Tersedia ratusan tenan makanan tradisional dan modern yang siap memanjakan lidah Anda.',
                'lokasi' => 'Alun-alun Kejaksan, Jl. Kartini, Cirebon',
                'harga_tiket' => 25000,
                'kapasitas' => 1000,
                'category_name' => 'Makanan',
                'organizer_id' => $admin ? $admin->id : $user->id, // Admin event
            ],
            [
                'judul' => 'JCE Meet Up - Sleman Yogyakarta',
                'description' => "Japanese Culture Enthusiast Meet Up (Sleman) merupakan acara temu komunitas yang ditujukan bagi para pecinta budaya Jepang, mulai dari anime, manga, musik, fashion, hingga tradisi dan kebiasaan Jepang. Kegiatan ini menjadi wadah untuk berbagi minat, pengetahuan, serta mempererat hubungan antar sesama penggemar budaya Jepang di wilayah Sleman dan sekitarnya.\n\nAcara ini akan diisi dengan berbagai kegiatan menarik seperti diskusi budaya Jepang, sharing pengalaman belajar bahasa Jepang, cosplay mini showcase, kuis interaktif, serta sesi networking antar komunitas. Dengan suasana santai dan inklusif, meet up ini terbuka untuk pemula maupun enthusiast yang ingin memperluas wawasan dan relasi.\n\nMelalui Japanese Culture Enthusiast Meet Up, diharapkan tercipta komunitas yang aktif, kreatif, dan saling mendukung dalam mengapresiasi budaya Jepang secara positif.",
                'lokasi' => 'Sleman City Hall, Jl. Magelang Km 9, Sleman, Yogyakarta',
                'harga_tiket' => 0,
                'kapasitas' => 100,
                'category_name' => 'Teknologi',
                'organizer_id' => $admin ? $admin->id : $user->id, // Admin event
            ],
            [
                'judul' => 'Konser Denny Caknan (Bandung 2026)',
                'description' => 'Ambyar bareng di konser spesial Denny Caknan! Siapkan hatimu untuk bernyanyi bersama lagu-lagu hits seperti Kartonyono Medot Janji dan Los Dol.',
                'lokasi' => 'Lapangan Gazibu, Jl. Diponegoro No.22, Bandung',
                'harga_tiket' => 150000,
                'kapasitas' => 5000,
                'category_name' => 'Musik',
                'organizer_id' => $admin ? $admin->id : $user->id, // Admin event
            ]
        ];

        // Create or Update events
        foreach ($eventsData as $data) {
            $startDate = Carbon::create(2026, rand(1, 12), rand(1, 28))->setHour(rand(8, 20));
            $category = Category::where('nama', $data['category_name'])->first() ?? $categories->first();
            
            // Use updateOrCreate to ensure description and other critical fields are synced
            // while keeping the event ID stable if it exists.
            Event::updateOrCreate(
                ['judul' => $data['judul']], // Search key
                [
                    'organizer_id' => $data['organizer_id'],
                    'category_id' => $category->id,
                    'visibility_id' => $publicVisibility->id,
                    'description' => $data['description'], // This ensures description is synced
                    'lokasi' => $data['lokasi'],
                    'harga_tiket' => $data['harga_tiket'],
                    'kapasitas' => $data['kapasitas'],
                    // Only set dates if creating new, to avoid resetting dates on existing events?
                    // Actually, updateOrCreate overwrites. To preserve edits but sync description, 
                    // we ideally want selective update. But for "teammate pull", overwriting 
                    // to the "correct" seed state is usually desired.
                    'waktu_mulai' => Event::where('judul', $data['judul'])->value('waktu_mulai') ?? $startDate,
                    'waktu_selesai' => Event::where('judul', $data['judul'])->value('waktu_selesai') ?? $startDate->copy()->addHours(rand(2, 5)),
                    'requires_approval' => rand(0, 1),
                    // 'image' => null // Don't overwrite image if it exists
                ]
            );
        }
    }
}
