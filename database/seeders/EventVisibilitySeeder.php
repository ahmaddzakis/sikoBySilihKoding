<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventVisibility;

class EventVisibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visibilities = [
            ['nama' => 'Publik', 'slug' => 'public'],
            ['nama' => 'Pribadi', 'slug' => 'private'],
        ];

        foreach ($visibilities as $visibility) {
            EventVisibility::updateOrCreate(['slug' => $visibility['slug']], $visibility);
        }
    }
}
