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
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->text('street_address')->nullable();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('maximum_stage_width')->nullable();
            $table->unsignedBigInteger('maximum_stage_depth')->nullable();
            $table->unsignedBigInteger('maximum_stage_height')->nullable();
            $table->unsignedBigInteger('maximum_seats')->nullable();
            $table->unsignedBigInteger('maximum_wheelchair_seats')->nullable();
            $table->unsignedBigInteger('number_of_dressing_rooms')->nullable();
            $table->boolean('backstage_wheelchair_access')->nullable();
            $table->foreignId('venue_type_id')->constrained();
            $table->foreignId('region_id')->constrained();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
