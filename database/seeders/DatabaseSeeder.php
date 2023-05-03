<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * The current Faker instance.
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
            VenueSeeder::class,
        ]);
    }
}
