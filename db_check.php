<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- DATABASE CHECK ---\n";
echo "Total events: " . \App\Models\Event::count() . "\n";
echo "Total users: " . \App\Models\User::count() . "\n";
echo "Total categories: " . \App\Models\Category::count() . "\n";
echo "Total visibilities: " . \App\Models\EventVisibility::count() . "\n";

echo "\nVisibilities:\n";
foreach (\App\Models\EventVisibility::all() as $v) {
    echo "ID: {$v->id} | Nama: {$v->nama} | Slug: {$v->slug}\n";
}

echo "\nCategories:\n";
foreach (\App\Models\Category::all() as $c) {
    echo "ID: {$c->id} | Nama: {$c->nama}\n";
}

echo "\nUsers:\n";
foreach (\App\Models\User::take(5)->get() as $u) {
    echo "ID: {$u->id} | Name: {$u->name} | Email: {$u->email}\n";
}

echo "\nEvents:\n";
foreach (\App\Models\Event::all() as $e) {
    echo "ID: {$e->id} | Judul: {$e->judul} | Vis: " . ($e->visibility->nama ?? 'NULL') . " | Organizer: {$e->organizer_id}\n";
}
echo "--- END CHECK ---\n";
