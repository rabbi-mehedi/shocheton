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
        Schema::table('reports', function (Blueprint $table) {
            $table->enum('report_type', ['offender', 'extortionist'])->default('offender')->after('user_id');
            $table->unsignedBigInteger('extortionist_id')->nullable()->after('offender_id');
            $table->foreign('extortionist_id')->references('id')->on('extortionists')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['extortionist_id']);
            $table->dropColumn('extortionist_id');
            $table->dropColumn('report_type');
        });
    }
};
