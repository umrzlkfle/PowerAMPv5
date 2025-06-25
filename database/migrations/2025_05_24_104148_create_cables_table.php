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
        Schema::create('cables', function (Blueprint $table) {
            $table->id();
            $table->string('circ_id')->nullable();
            $table->string('status');
            $table->string('phasing')->nullable();
            $table->string('voltage');
            $table->string('class')->nullable();
            $table->string('owner_type');
            $table->string('owner_name');
            $table->string('from_info')->nullable();
            $table->string('to_info')->nullable();
            $table->string('label');
            $table->string('op_area');
            $table->string('SubstationLabel')->nullable();
            $table->string('FromToName')->nullable();
            $table->string('FromLabel')->nullable();
            $table->string('ToLabel')->nullable();

            // Add foreign key for 'FromLabel' referencing 'substations.label'
            // Ensure that 'FromLabel' column exists and has the same type as 'substations.label'
            // And also that it is nullable if the relationship is not always present
            $table->foreign('FromLabel')->references('label')->on('substations')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cables', function (Blueprint $table) {
                $table->dropForeign(['FromLabel']);
            });
        Schema::dropIfExists('cables');
    }
};