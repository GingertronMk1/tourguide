<?php

use App\Models\AccessEquipment;
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
        Schema::create('access_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $initial_equipments = [
            'Caption Screen',
            'Audio Enhancement Equipment',
            'Quiet Space',
            'BSL Position'
        ];

        foreach($initial_equipments as $equipment) {
            AccessEquipment::create(['name' => $equipment]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_equipment');
    }
};
