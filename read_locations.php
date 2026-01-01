<?php

use App\Models\Event;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$events = Event::all();
foreach ($events as $event) {
    echo "Title: {$event->judul} \nLocation: {$event->lokasi}\n---\n";
}
