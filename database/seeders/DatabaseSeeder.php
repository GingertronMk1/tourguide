<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Database\Seeder;

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

    }
}
