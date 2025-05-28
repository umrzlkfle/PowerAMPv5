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
        Schema::create('circuits', function (Blueprint $table) {
            $table->id();
            $table->string('original_id')->nullable();
            $table->string('circ_id')->nullable();
            $table->string('circ_id2')->nullable();
            $table->string('circuit_id')->nullable();
            $table->string('status')->nullable();
            $table->string('phasing')->nullable();
            $table->string('voltage')->nullable();
            $table->string('class')->nullable();
            $table->string('owner_type')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('from_info')->nullable();
            $table->string('to_info')->nullable();
            $table->string('label')->nullable();
            $table->string('op_area')->nullable();
            $table->float('cal_length')->nullable();
            $table->string('status_act')->nullable();
            $table->string('circ_label')->nullable();
            $table->string('processed_file_path')->nullable();
            $table->timestamps();
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
