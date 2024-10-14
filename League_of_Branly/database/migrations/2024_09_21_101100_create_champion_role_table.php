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
        Schema::create('champion_role', function (Blueprint $table) {
            // Foreign keys referencing champions and roles
            $table->foreignId('champion_id')->constrained('champions')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');

            // Add timestamps if needed
            $table->timestamps();

            // Optional: Add primary key for the composite key
            $table->primary(['champion_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('champion_role');
    }
};
