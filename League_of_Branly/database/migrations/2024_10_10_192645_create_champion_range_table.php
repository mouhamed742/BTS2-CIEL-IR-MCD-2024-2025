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
        Schema::create('champion_range', function (Blueprint $table) {
            $table->id();
            $table->foreignId('champion_id')->constrained()->onDelete('cascade');
            $table->foreignId('range_id')->constrained()->onDelete('cascade');
            $table->unique(['champion_id', 'range_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('champion_range');
    }
};
