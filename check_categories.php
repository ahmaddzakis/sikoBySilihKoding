<?php

use App\Models\Category;

// Ensure autoloader
require __DIR__ . '/vendor/autoload.php';

// Bootstrap code to set up Laravel app creates access to Eloquent
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$categories = Category::all();
foreach ($categories as $category) {
    echo "ID: " . $category->id . " - Name: " . $category->nama . "\n";
}
