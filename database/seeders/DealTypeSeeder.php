<?php

namespace Database\Seeders;

use App\Models\DealType;
use Illuminate\Database\Seeder;

class DealTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $initial_types = [
            DealType::SYSTEM_HIRE => 'Hire',
            DealType::SYSTEM_SPLIT => 'Split',
            DealType::SYSTEM_GUARANTEE => 'Guarantee',
        ];

        foreach ($initial_types as $system => $name) {
            if (is_null(DealType::getSystemType($system))) {
                $dealType = new DealType;
                $dealType->system = $system;
                $dealType->name = $name;
                $dealType->save();
            }
        }

    }
}
