<?php

declare(strict_types=1);

use App\Models\AccessEquipment;
use App\Models\Venue;
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
        Schema::create('access_equipment_venue', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AccessEquipment::class)->constrained('access_equipment');
            $table->foreignIdFor(Venue::class)->constrained();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_equipment_venue');
    }
};
