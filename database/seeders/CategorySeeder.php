<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama' => 'Konferensi', 'deskripsi' => 'Acara konferensi teknologi dan bisnis'],
            ['nama' => 'Workshop', 'deskripsi' => 'Pelatihan intensif dan praktis'],
            ['nama' => 'Meetup', 'deskripsi' => 'Pertemuan komunitas santai'],
            ['nama' => 'Seminar', 'deskripsi' => 'Sesi berbagi ilmu dan tren terbaru'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
