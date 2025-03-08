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
        Schema::create('offenders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age')->nullable();
            $table->enum('gender',['male','female','other'])->nullable();
            $table->text('crime_description');
            $table->enum('offense_type', ['Rape', 'Attempted Rape', 'Child Sexual Abuse', 'Molestation', 'Sexual Harassment', 'Cyber Harassment', 'Blackmail', 'Stalking', 'Other']);
            $table->string('location')->nullable();
            $table->enum('status', ['allegedly', 'confirmed', 'disproven'])->default('allegedly');
            $table->text('evidence')->nullable(); // Store evidence links
            $table->enum('risk_level', ['low', 'medium', 'high'])->default('medium');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offenders');
    }
};
