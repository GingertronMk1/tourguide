<?php

use App\Models\DealType;
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
        Schema::create('deal_type_venue', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DealType::class)->constrained();
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
        Schema::dropIfExists('deal_type_venue');
    }
};
