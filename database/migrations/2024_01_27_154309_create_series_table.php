<?php

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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->string("title", 300)->unique();
            $table->text("description")->default("");
            $table->string("painter")->default("unknown");
            $table->string("author")->default("unknown");
            $table->string("other_names", 500)->default("");
            $table->text("genres")->default("");
            $table->string("type");
            $table->string("status");
            $table->date("release_date");
            $table->boolean("published")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
