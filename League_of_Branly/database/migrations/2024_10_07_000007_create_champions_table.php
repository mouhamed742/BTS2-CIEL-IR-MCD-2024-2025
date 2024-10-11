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
        Schema::create('champions', function (Blueprint $table) {
            $table->id('champion_id');
            $table->string('name')->unique();
            $table->string('title')->nullable();
            $table->text('lore')->nullable();
            $table->date('release_date')->nullable();
            $table->foreignId('gender_id')->nullable()->constrained();
            $table->foreignId('resource_id')->nullable()->constrained('resources');
            $table->foreignId('year_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('champions');
    }
};
