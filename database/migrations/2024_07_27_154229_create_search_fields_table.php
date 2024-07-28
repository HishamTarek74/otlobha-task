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
        Schema::create('search_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('min_value')->nullable();
            $table->text('max_value')->nullable();
            $table->foreignId('search_profile_id')->constrained('search_profiles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_fields');
    }
};
