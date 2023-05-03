<?php

use App\Models\Area;
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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->integer('system')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $initial_areas = [
            Area::SYSTEM_NORTH => 'North',
            Area::SYSTEM_MIDLANDS => 'Midlands',
            Area::SYSTEM_SOUTH_EAST => 'South West',
            Area::SYSTEM_SOUTH_WEST => 'South East',
            Area::SYSTEM_LONDON => 'London',
        ];

        foreach ($initial_areas as $system => $name) {
            $area = new Area;
            $area->name = $name;
            $area->system = $system;
            $area->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
