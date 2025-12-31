<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama' => 'Teknologi', 'deskripsi' => 'Acara seputar pengembangan software, gadget, dan inovasi terbaru.'],
            ['nama' => 'Makanan', 'deskripsi' => 'Festival kuliner, workshop memasak, dan petualangan rasa.'],
            ['nama' => 'Musik', 'deskripsi' => 'Konser, festival musik, dan pertunjukan live dari berbagai genre.'],
            ['nama' => 'Seni', 'deskripsi' => 'Pameran seni, workshop kreatif, dan galeri desain.'],
            ['nama' => 'Kesehatan', 'deskripsi' => 'Seminar kesehatan, yoga, dan tips gaya hidup publik.'],
            ['nama' => 'Ai', 'deskripsi' => 'Kecerdasan buatan, machine learning, dan masa depan digital.'],
            ['nama' => 'Iklim', 'deskripsi' => 'Acara lingkungan, keberlanjutan, dan edukasi ekologi.'],
            ['nama' => 'Kebugaran', 'deskripsi' => 'Olahraga, fitness, lari marathon, dan kegiatan fisik lainnya.'],
            ['nama' => 'Lainnya', 'deskripsi' => 'Temukan berbagai acara menarik lainnya.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['nama' => $category['nama']], $category);
        }
    }
}
