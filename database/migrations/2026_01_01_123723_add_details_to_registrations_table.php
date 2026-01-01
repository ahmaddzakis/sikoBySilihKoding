<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Columns already added by previous migrations:
        // name, phone -> 2025_12_30_112648
        // payment_proof -> 2025_12_31_140500
    }

    public function down(): void
    {
        // Nothing to reverse
    }
};
