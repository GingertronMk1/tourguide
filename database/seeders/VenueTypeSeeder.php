<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\VenueType;
use Illuminate\Database\Seeder;

class VenueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initial_types = [
            VenueType::SYSTEM_THEATRE => 'Theatre',
            VenueType::SYSTEM_ARTS_CENTRE => 'Arts Centre',
            VenueType::SYSTEM_OUTDOOR_THEATRE => 'Outdoor theatre',
            VenueType::SYSTEM_COMMUNITY_VENUE => 'Community Venue',
            VenueType::SYSTEM_LIBRARY => 'Library',
        ];

        foreach ($initial_types as $system => $name) {
            if (is_null(VenueType::getSystemType($system))) {
                $newType = new VenueType;
                $newType->name = $name;
                $newType->system = $system;
                $newType->save();
            }
        }

    }
}
