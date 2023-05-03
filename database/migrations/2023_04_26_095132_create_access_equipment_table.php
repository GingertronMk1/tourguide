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
            $table->integer('system')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $initial_equipments = [
            AccessEquipment::SYSTEM_CAPTION_SCREEN => 'Caption Screen',
            AccessEquipment::SYSTEM_AUDIO_ENHANCEMENT_EQUIPMENT => 'Audio Enhancement Equipment',
            AccessEquipment::SYSTEM_QUIET_SPACE => 'Quiet Space',
            AccessEquipment::SYSTEM_BSL_POSITION => 'BSL Position',
        ];

        foreach ($initial_equipments as $system => $name) {
            $accessEquipment = new AccessEquipment;
            $accessEquipment->name = $name;
            $accessEquipment->system = $system;
            $accessEquipment->save();
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
