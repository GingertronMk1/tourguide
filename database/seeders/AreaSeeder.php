<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initial_areas = [
            Area::SYSTEM_NORTH => 'North',
            Area::SYSTEM_MIDLANDS => 'Midlands',
            Area::SYSTEM_SOUTH_EAST => 'South West',
            Area::SYSTEM_SOUTH_WEST => 'South East',
            Area::SYSTEM_LONDON => 'London',
        ];

        foreach ($initial_areas as $system => $name) {
            if (is_null(Area::getSystemType($system))) {
                $area = new Area;
                $area->name = $name;
                $area->system = $system;
                $area->save();
            } else {
                echo "Area with system value {$system} found\n";
            }
        }

    }
}
