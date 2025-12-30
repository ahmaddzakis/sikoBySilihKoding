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

        $eventTitles = [
            'Tech Workshop 2026',
            'Music Festival Jakarta',
            'Art Exhibition',
            'Business Seminar',
            'Community Meetup'
        ];

        $locations = ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Bali'];

        for ($i = 0; $i < 5; $i++) {
            $startDate = Carbon::create(2026, 1, 1)->addDays(rand(0, 9))->setHour(rand(8, 20));

            Event::create([
                'organizer_id' => $user->id,
                'category_id' => $categories->random()->id,
                'visibility_id' => $publicVisibility->id,
                'judul' => $eventTitles[$i],
                'description' => 'Ini adalah deskripsi untuk ' . $eventTitles[$i] . '. Bergabunglah dengan kami untuk pengalaman luar biasa.',
                'lokasi' => $locations[array_rand($locations)],
                'waktu_mulai' => $startDate,
                'waktu_selesai' => $startDate->copy()->addHours(3),
                'harga_tiket' => rand(0, 1) ? rand(50000, 500000) : 0,
                'requires_approval' => rand(0, 1),
                'kapasitas' => rand(50, 500),
            ]);
        }
    }
}
