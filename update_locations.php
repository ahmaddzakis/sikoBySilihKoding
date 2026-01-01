<?php

use App\Models\Event;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Define mapping of Title -> New Location
$updates = [
    "Sigit's Birthday!" => "Jl. Kemang Raya No. 12, Pela Mampang, Jakarta Selatan",
    "Cirebon Cullinary Festival" => "Alun-alun Kejaksan, Jl. Kartini, Cirebon",
    "JCE Meet Up - Sleman Yogyakarta" => "Sleman City Hall, Jl. Magelang Km 9, Sleman, Yogyakarta",
    "Konser Denny Caknan (Bandung 2026)" => "Lapangan Gazibu, Jl. Diponegoro No.22, Bandung"
];

foreach ($updates as $title => $location) {
    try {
        $event = Event::where('judul', $title)->first();
        if ($event) {
            $event->lokasi = $location;
            $event->save();
            echo "Updated: $title -> $location\n";
        } else {
            echo "Skipped (Not Found): $title\n";
        }
    } catch (\Exception $e) {
        echo "Error updating $title: " . $e->getMessage() . "\n";
    }
}
