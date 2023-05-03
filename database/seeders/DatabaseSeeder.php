<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AccessEquipment;
use App\Models\Area;
use App\Models\DealType;
use App\Models\User;
use App\Models\Venue;
use App\Models\VenueType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!User::where('email', '=', 'admin@tourguide.test')) {
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
            VenueTypeSeeder::class
        ]);

        if(in_array(config('app.env'), ['local', 'testing'])) {
            Area::all()->each(function (Area $area) {
                $accessEquipment = AccessEquipment::all();
                $dealTypes = DealType::all();
                $venueTypes = VenueType::all();

                $numberOfAccessEquipments = $accessEquipment->count();
                $numberOfDealTypes = $dealTypes->count();
                $numberOfVenueTypes = $venueTypes->count();

                $accessEquipmentOffset = 0;
                $accessEquipmentLimit = 0;
                foreach($area->regions as $region) {

                }
            });
        }
    }
}
