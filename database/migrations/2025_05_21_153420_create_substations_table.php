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
        Schema::create('substations', function (Blueprint $table) {
            $table->id();
            $table->string('substation_id')->unique()->nullable();
            $table->string('status')->nullable();
            $table->string('name')->nullable();
            $table->string('owner_type')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('design')->nullable();
            $table->string('voltage')->nullable();
            // Make 'label' unique as it will be used as a foreign key reference
            $table->string('label')->unique()->nullable();
            $table->string('functional_location')->nullable();
            $table->string('operational_area')->nullable();
            $table->string('category')->nullable();
            $table->string('status_act')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('substations');
    }
};