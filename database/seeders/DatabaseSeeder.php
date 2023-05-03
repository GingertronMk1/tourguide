<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AccessEquipment;
use App\Models\Area;
use App\Models\DealType;
use App\Models\User;
use App\Models\VenueType;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
        /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected Generator $faker;

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = Container::getInstance()->make(Generator::class);
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! User::where('email', '=', 'admin@tourguide.test')) {
            $user = new User();
            $user->name = 'Admin';
            $user->email = 'admin@tourguide.test';
            $user->password = bcrypt('12345');
            $user->email_verified_at = date('Y-m-d\TH:i:s');
            $user->save();
        }

        $this->call([
            AreaSeeder::class,
            RegionSeeder::class,
            AccessEquipmentSeeder::class,
            DealTypeSeeder::class,
            VenueTypeSeeder::class,
        ]);

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
                foreach ($area->regions as $region) {
                    $accessEquipmentLimit = (++$accessEquipmentLimit) % $accessEquipmentCount;
                    $dealTypeLimit = (++$dealTypeLimit) % $dealTypeCount;
                    $venueTypeOffset = (++$venueTypeOffset) % $venueTypeCount;
                    if ($accessEquipmentLimit === 0) {
                        $accessEquipmentOffset = (++$accessEquipmentOffset) % $accessEquipmentCount;
                    }
                    if ($dealTypeLimit === 0) {
                        $dealTypeOffset = (++$dealTypeOffset) % $dealTypeCount;
                    }

                    $stageDimension = ($dealTypeLimit + 1) * ($accessEquipmentLimit + 1) * 100;
                    $seats = 100;
                    echo "Creating venue for {$region->name}\n\n";
                    $venue = $region->venues()->create([
                        'name' => "{$region->name} Theatre",
                        'venue_type_id' => $venueTypes->values()->get($venueTypeOffset)->id,
                        'maximum_stage_width' => $stageDimension,
                        'maximum_stage_depth' => $stageDimension,
                        'maximum_stage_height' => $stageDimension,
                        'maximum_seats' => $seats,
                        'maximum_wheelchair_seats' => $seats / 10,
                        'number_of_dressing_rooms' => $stageDimension / 10,
                        'backstage_wheelchair_access' => $venueTypeOffset % 2,
                        'street_address' => "1 Main Street\n{$region->name}\n{$region->area->name}",
                        'city' => "{$region->name} City"
                    ]);

                    $venue->accessEquipment()->attach($accessEquipment->slice($accessEquipmentOffset, $accessEquipmentLimit)->pluck('id'));
                    $venue->dealTypes()->attach($dealTypes->slice($dealTypeOffset, $dealTypeLimit)->pluck('id'));
                }
            });
        }
    }
}
