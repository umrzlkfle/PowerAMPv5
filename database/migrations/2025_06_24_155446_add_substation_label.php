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
        Schema::table('breakdown_records', function (Blueprint $table) {
            // Add the new column
            $table->string('substation_label')->nullable()->after('substation_name'); // Adjust 'some_existing_column' to place it correctly

            // Add the foreign key constraint
            $table->foreign('substation_label')->references('label')->on('substations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('breakdown_records', function (Blueprint $table) {
            $table->dropForeign(['substation_label']); // Drop the foreign key constraint first
            $table->dropColumn('substation_label'); // Then drop the column
        });
    }
};