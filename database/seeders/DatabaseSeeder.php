<?php

declare(strict_types=1);

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
        $adminEmail = 'admin@tourguide.test';
        if (
            (! User::where('email', '=', $adminEmail)->first()) &&
            in_array(config('app.env'), ['local', 'testing'])
        ) {
            echo "No user found for email {$adminEmail}";
            $user = new User();
            $user->name = 'Admin';
            $user->email = 'admin@tourguide.test';
            $user->password = bcrypt('12345');
            $user->email_verified_at = date('Y-m-d\TH:i:s');
            $user->save();
        } else {
            echo "Found user with email {$adminEmail}";
        }

        echo "\n";

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
