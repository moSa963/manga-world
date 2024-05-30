<?php

use App\Models\Genre;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });

        Genre::create(['name' => 'shonen']);
        Genre::create(['name' => 'shoujo']);
        Genre::create(['name' => 'seinen']);
        Genre::create(['name' => 'comedy']);
        Genre::create(['name' => 'action']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genres');
    }
};
