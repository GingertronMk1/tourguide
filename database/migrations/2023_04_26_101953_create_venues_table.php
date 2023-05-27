<?php

declare(strict_types=1);

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
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->text('street_address');
            $table->string('city');
            $table->foreignIdFor(Region::class)->constrained();
            $table->foreignIdFor(VenueType::class)->constrained();
            $table->unsignedBigInteger('maximum_stage_width');
            $table->unsignedBigInteger('maximum_stage_depth');
            $table->unsignedBigInteger('maximum_stage_height');
            $table->unsignedBigInteger('maximum_seats');
            $table->unsignedBigInteger('maximum_wheelchair_seats');
            $table->unsignedBigInteger('number_of_dressing_rooms');
            $table->boolean('backstage_wheelchair_access');
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
