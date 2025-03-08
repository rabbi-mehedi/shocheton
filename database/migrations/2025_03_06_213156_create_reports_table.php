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
            $table->unsignedBigInteger('user_id');
            
            $table->unsignedBigInteger('offender_id');
            $table->foreign('offender_id')->references('id')->on('offenders')->onDelete('cascade');

            $table->enum('offender_relation_to_victim', ['Stranger', 'Family Member', 'Teacher', 'Colleague', 'Neighbor', 'Police', 'Partner', 'Religious Leader', 'Other'])->nullable();
            $table->enum('police_status', ['unreported', 'in-Progress', 'reported'])->default('unreported');
            $table->string('police_station')->nullable();
            $table->boolean('needs_legal_support')->default(false);
            $table->boolean('needs_ngo_support')->default(false);
            $table->enum('privacy_level', ['public', 'private'])->default('public');
            $table->boolean('contact_permission')->nullable();
            $table->text('additional_details')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
