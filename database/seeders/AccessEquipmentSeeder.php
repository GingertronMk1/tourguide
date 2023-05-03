<?php

namespace Database\Seeders;

use App\Models\AccessEquipment;
use Illuminate\Database\Seeder;

class AccessEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initial_equipments = [
            AccessEquipment::SYSTEM_CAPTION_SCREEN => 'Caption Screen',
            AccessEquipment::SYSTEM_AUDIO_ENHANCEMENT_EQUIPMENT => 'Audio Enhancement Equipment',
            AccessEquipment::SYSTEM_QUIET_SPACE => 'Quiet Space',
            AccessEquipment::SYSTEM_BSL_POSITION => 'BSL Position',
        ];

        foreach ($initial_equipments as $system => $name) {
            if (is_null(AccessEquipment::getSystemType($system))) {
                $accessEquipment = new AccessEquipment;
                $accessEquipment->name = $name;
                $accessEquipment->system = $system;
                $accessEquipment->save();
            }
        }

    }
}
