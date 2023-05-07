<?php

use App\Models\Region;
use App\Models\VenueType;
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
            // Basic venue details
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();

            // Venue address/location details
            $table->text('street_address')->nullable();
            $table->string('city')->nullable();
            $table->foreignIdFor(Region::class)->constrained();
            $table->foreignIdFor(VenueType::class)->constrained();

            // General details
            $table->unsignedBigInteger('number_of_dressing_rooms');
            $table->unsignedBigInteger('maximum_seats');
            $table->unsignedBigInteger('maximum_stage_width');
            $table->unsignedBigInteger('maximum_stage_depth');
            $table->unsignedBigInteger('maximum_stage_height');

            // Accessibility details
            $table->boolean('backstage_wheelchair_access');
            $table->boolean('rig_wheelchair_access');
            $table->unsignedBigInteger('maximum_wheelchair_seats');

            // Technical details
            $table->string('tech_notes')->nullable();
            $table->boolean('has_dance_floor');
            $table->string('has_sprung_floor');
            $table->text('public_address');
            $table->text('sound_desk');
            $table->boolean('qlab');
            $table->float('qlab_version')->nullable();
            $table->text('lx_notes')->nullable();
            $table->string('lx_desk');
            $table->integer('number_of_booms');
            $table->text('laundry_service');
            $table->text('green_room_information');
            $table->integer('rig_minimum_safe_working_load');
            $table->text('rig_safe_working_load_notes');

            // Nerd shit
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
