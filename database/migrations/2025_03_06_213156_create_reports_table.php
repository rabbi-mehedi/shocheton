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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('offender_id')->nullable()->constrained('offenders')->onDelete('cascade');
            $table->enum('offender_relation_to_victim', ['Stranger', 'Family Member', 'Teacher', 'Colleague', 'Neighbor', 'Police', 'Partner', 'Religious Leader', 'Other'])->nullable();
            $table->enum('police_status', ['unreported', 'in-Progress', 'reported'])->default('unreported');
            $table->string('police_station')->nullable();
            $table->boolean('needs_legal_support')->default(false);
            $table->boolean('needs_ngo_support')->default(false);
            $table->enum('privacy_level', ['public', 'private'])->default('public');
            $table->boolean('contact_permission')->nullable();
            $table->text('additional_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
