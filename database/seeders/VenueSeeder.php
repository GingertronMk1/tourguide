<?php

namespace Database\Seeders;

use App\Models\AccessEquipment;
use App\Models\Area;
use App\Models\DealType;
use App\Models\VenueType;
use Faker\Generator;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    public function __construct(
        protected Generator $faker,
    ) {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (in_array(config('app.env'), ['local', 'testing'])) {
            echo "Local or testing environment detected. Creating venues...\n";
            Area::all()->each(function (Area $area) {
                $accessEquipment = AccessEquipment::all();
                $dealTypes = DealType::all();
                $venueTypes = VenueType::all();

                $accessEquipmentCount = $accessEquipment->count();
                $dealTypeCount = $dealTypes->count();
                $venueTypeCount = $venueTypes->count();

                $accessEquipmentOffset = 0;
                $accessEquipmentLimit = 0;
                $dealTypeOffset = 0;
                $dealTypeLimit = 0;
                $venueTypeOffset = 0;
                $seats = 0;
                foreach ($area->regions as $region) {
                    $accessEquipmentLimit = ($accessEquipmentLimit + 1) % $accessEquipmentCount;
                    $dealTypeLimit = ($dealTypeLimit + 1) % $dealTypeCount;
                    $venueTypeOffset = ($venueTypeOffset + 1) % $venueTypeCount;

                    if ($accessEquipmentLimit === 0) {
                        $accessEquipmentOffset = ($accessEquipmentOffset + 1) % $accessEquipmentCount;
                    }
                    if ($dealTypeLimit === 0) {
                        $dealTypeOffset = ($dealTypeOffset + 1) % $dealTypeCount;
                    }

                    $stageDimension = $dealTypeLimit * $accessEquipmentLimit * 100;
                    $seats = ($seats % 1000) + 100;
                    echo "Creating venue for {$region->name}\n\n";
                    $venue = $region->venues()->create([
                        'name' => "{$region->name} Theatre",
                        'venue_type_id' => $venueTypes->values()->get($venueTypeOffset)->id,
                        'description' => $this->faker->sentences(5, true),
                        'notes' => $this->faker->sentences(3, true),
                        'maximum_stage_width' => $stageDimension,
                        'maximum_stage_depth' => $stageDimension,
                        'maximum_stage_height' => $stageDimension,
                        'maximum_seats' => $seats,
                        'maximum_wheelchair_seats' => $seats / 10,
                        'number_of_dressing_rooms' => $stageDimension / 10,
                        'backstage_wheelchair_access' => $venueTypeOffset % 2,
                        'street_address' => "1 Main Street\n{$region->name}\n{$region->area->name}",
                        'city' => "{$region->name} City",
                    ]);

                    $accessEquipmentIds = $accessEquipment->slice($accessEquipmentOffset, $accessEquipmentLimit)->pluck('id');
                    $dealTypeIds = $dealTypes->slice($dealTypeOffset, $dealTypeLimit)->pluck('id');

                    $accessEquipmentToAttach = [];
                    $dealTypesToAttach = [];

                    foreach ($accessEquipmentIds as $id) {
                        $accessEquipmentToAttach[$id] = ['notes' => $this->faker->sentences(3, true)];
                    }

                    foreach ($dealTypeIds as $id) {
                        $dealTypesToAttach[$id] = ['notes' => $this->faker->sentences(3, true)];
                    }

                    $venue->accessEquipment()->attach($accessEquipmentToAttach);
                    $venue->dealTypes()->attach($dealTypesToAttach);
                }
            });
        } else {
            echo 'Not seeding venues because in production';
        }
    }
}
