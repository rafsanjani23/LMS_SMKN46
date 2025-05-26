<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Teachers table
        DB::statement("ALTER TABLE teachers MODIFY major ENUM('pplg', 'dkv', 'akl', 'mp', 'bdp', 'umum')");

        // Classrooms table
        DB::statement("ALTER TABLE classrooms MODIFY major ENUM('pplg', 'dkv', 'akl', 'mp', 'bdp', 'umum')");
    }

    public function down(): void
    {
        // Revert to original enum (tanpa 'umum')
        DB::statement("ALTER TABLE teachers MODIFY major ENUM('pplg', 'dkv', 'akl', 'mp', 'bdp')");
        DB::statement("ALTER TABLE classrooms MODIFY major ENUM('pplg', 'dkv', 'akl', 'mp', 'bdp')");
    }
};

