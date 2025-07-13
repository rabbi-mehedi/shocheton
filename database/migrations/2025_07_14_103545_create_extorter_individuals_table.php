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
        Schema::create('extorter_individuals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('extortionist_id');
            $table->foreign('extortionist_id')->references('id')->on('extortionists')->onDelete('cascade');
            
            $table->string('name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('position')->nullable();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extorter_individuals');
    }
}; 