<?php

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
        Schema::create('venue_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->smallInteger('system')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $initial_types = [
            VenueType::SYSTEM_THEATRE => 'Theatre',
            VenueType::SYSTEM_ARTS_CENTRE => 'Arts Centre',
            VenueType::SYSTEM_OUTDOOR_THEATRE => 'Outdoor theatre',
            VenueType::SYSTEM_COMMUNITY_VENUE => 'Community Venue',
            VenueType::SYSTEM_LIBRARY => 'Library',
        ];

        foreach ($initial_types as $system => $name) {
            $newType = new VenueType;
            $newType->name = $name;
            $newType->system = $system;
            $newType->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venue_types');
    }
};
