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
        Schema::create('extortionists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id');
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
            
            $table->string('name')->nullable();
            $table->string('position')->nullable(); // Position/role in organization
            $table->string('political_affiliation')->nullable(); // e.g., AL, BNP, Chhatra League, Jubo League
            
            // Business/target details
            $table->string('business_name')->nullable();
            $table->string('business_sector')->nullable();
            $table->string('business_address_district')->nullable();
            $table->string('business_address_upazila')->nullable();
            $table->string('business_address_detail')->nullable();
            
            // Incident details
            $table->decimal('demanded_amount', 12, 2)->nullable();
            $table->enum('approach_method', ['In Person', 'Phone Call', 'SMS', 'Social Media', 'Through Associates', 'Other'])->nullable();
            $table->boolean('recurring_demand')->default(false);
            $table->text('threat_description')->nullable();
            $table->enum('status', ['allegedly', 'confirmed', 'disproven'])->default('allegedly');
            $table->enum('risk_level', ['low', 'medium', 'high'])->default('medium');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extortionists');
    }
};
