<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AccessEquipment;
use App\Models\DealType;
use App\Models\Region;
use App\Models\VenueType;
use Faker\Generator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    private int $accessEquipmentOffset = 0;

    private int $accessEquipmentLimit = 0;

    private int $dealTypeOffset = 0;

    private int $dealTypeLimit = 0;

    private int $venueTypeOffset = 0;

    private int $seats = 0;

    private int $accessEquipmentCount = 0;

    private int $dealTypeCount = 0;

    private int $venueTypeCount = 0;

    private Collection $accessEquipment;

    private Collection $dealTypes;

    private Collection $venueTypes;

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
            $this->accessEquipment = AccessEquipment::whereNotNull('system')->get();
            $this->dealTypes = DealType::whereNotNull('system')->get();
            $this->venueTypes = VenueType::whereNotNull('system')->get();

            $this->accessEquipmentCount = $this->accessEquipment->count();
            $this->dealTypeCount = $this->dealTypes->count();
            $this->venueTypeCount = $this->venueTypes->count();

            Region::orderBy('name', 'asc')->get()->each(function (Region $region) {

                /** Setting the limits and offsets on each go round to increment by 1 */
                $this->accessEquipmentLimit = ($this->accessEquipmentLimit + 1) % $this->accessEquipmentCount;
                $this->dealTypeLimit = ($this->dealTypeLimit + 1) % $this->dealTypeCount;
                $this->venueTypeOffset = ($this->venueTypeOffset + 1) % $this->venueTypeCount;

                /** If/when the limits are 0 increase the offset to go again */
                if ($this->accessEquipmentLimit === 0) {
                    $this->accessEquipmentOffset = ($this->accessEquipmentOffset + 1) % $this->accessEquipmentCount;
                }
                if ($this->dealTypeLimit === 0) {
                    $this->dealTypeOffset = ($this->dealTypeOffset + 1) % $this->dealTypeCount;
                }

                $stageDimension = $this->dealTypeLimit * $this->accessEquipmentLimit * 100;
                $this->seats = ($this->seats % 1000) + 100;
                echo "Creating venue for {$region->name}\n\n";
                $venue = $region->venues()->create([
                    'name' => "{$region->name} Theatre",
                    'venue_type_id' => $this->venueTypes->values()->get($this->venueTypeOffset)->id,
                    'description' => $this->faker->sentences(5, true),
                    'notes' => $this->faker->sentences(3, true),
                    'maximum_stage_width' => $stageDimension,
                    'maximum_stage_depth' => $stageDimension,
                    'maximum_stage_height' => $stageDimension,
                    'maximum_seats' => $this->seats,
                    'maximum_wheelchair_seats' => $this->seats / 10,
                    'number_of_dressing_rooms' => $stageDimension / 10,
                    'backstage_wheelchair_access' => $this->venueTypeOffset % 2,
                    'street_address' => "1 Main Street\n{$region->name}\n{$region->area->name}",
                    'city' => "{$region->name} City",
                ]);

                $accessEquipmentIds = $this
                    ->accessEquipment
                    ->slice(
                        $this->accessEquipmentOffset,
                        $this->accessEquipmentLimit
                    )
                    ->pluck('id');
                $dealTypeIds = $this
                    ->dealTypes
                    ->slice(
                        $this->dealTypeOffset,
                        $this->dealTypeLimit
                    )
                    ->pluck('id');

                $accessEquipmentToAttach = [];
                $dealTypesToAttach = [];

                foreach ($accessEquipmentIds as $id) {
                    $accessEquipmentToAttach[$id] = [
                        'notes' => $this->faker->sentences(3, true),
                    ];
                }

                foreach ($dealTypeIds as $id) {
                    $dealTypesToAttach[$id] = [
                        'notes' => $this->faker->sentences(3, true),
                    ];
                }

                $venue->accessEquipment()->attach($accessEquipmentToAttach);
                $venue->dealTypes()->attach($dealTypesToAttach);
            });
        } else {
            echo 'Not seeding venues because in production';
        }
    }
}
