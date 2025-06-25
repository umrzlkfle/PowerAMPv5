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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('functional_location')->unique();
            $table->text('description')->nullable();
            $table->string('sap_functional_location')->nullable()->unique();
            $table->string('status')->nullable();
            $table->string('vertical')->nullable();
            $table->string('subvertical')->nullable();
            $table->string('location_category')->nullable();
            $table->string('voltage_level')->nullable();
            $table->string('business_area')->nullable();
            $table->string('maintenance_work_center')->nullable();
            $table->string('station_area')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('functional_location');
            $table->index('sap_functional_location');
            $table->index('status');
            $table->index('vertical');
            $table->index('business_area');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
