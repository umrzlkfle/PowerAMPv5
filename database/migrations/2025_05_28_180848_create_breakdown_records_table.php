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
        Schema::create('breakdown_records', function (Blueprint $table) {
            $table->id();

            $table->string('tripping_document_id')->nullable();
            $table->string('tripping_no')->nullable();
            $table->string('source')->nullable();
            $table->string('scada_non_scada')->nullable();
            $table->string('ap_name')->nullable();
            $table->string('tripping_point')->nullable();
            $table->decimal('voltage')->nullable();
            $table->decimal('load_loss', 12, 2)->nullable();
            $table->dateTime('dispatch_date_time')->nullable();
            $table->dateTime('arrival_date_time')->nullable();
            $table->decimal('ap_response_time', 8, 2)->nullable();
            $table->string('state')->nullable();
            $table->string('station')->nullable();
            $table->dateTime('tripping_date_time')->nullable();
            $table->dateTime('restoration_date_time')->nullable();
            $table->text('remarks')->nullable();
            $table->string('failure_mode')->nullable();
            $table->text('description_damage_area')->nullable();
            // Add foreign key for 'substation_name' referencing 'substations.label'
            // Ensure that 'substation_name' column exists and has the same type as 'substations.label'
            // And also that it is nullable if the relationship is not always present
            $table->string('substation_name')->nullable();


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('breakdown_records', function (Blueprint $table) {
                $table->dropForeign(['substation_name']);
            });
        Schema::dropIfExists('breakdown_records');
    }
};