<?php

namespace Database\Factories;

use App\Models\AccessEquipment;
use App\Models\DealType;
use App\Models\Region;
use App\Models\Venue;
use App\Models\VenueType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{

    public function configure(): static
    {
        return $this->afterCreating(function(Venue $venue) {
            $numberOfAccessEquipments = random_int(0, 5);
            $numberOfDealTypes = random_int(0, 5);
            $accessEquipments = AccessEquipment::inRandomOrder()->limit($numberOfAccessEquipments)->pluck('id')->toArray();
            $dealTypes = DealType::inRandomOrder()->limit($numberOfDealTypes)->pluck('id')->toArray();
            $venue->dealTypes()->attach($dealTypes);
            $venue->accessEquipment()->attach($accessEquipments);
        });
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name . ' Theatre',
            'description' => $this->faker->text,
            'notes' => $this->faker->text,
            'street_address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'region_id' => Region::inRandomOrder()->first()->id,
            'venue_type_id' => VenueType::inRandomOrder()->first()->id,
            'maximum_stage_width' => $this->faker->randomNumber(3),
            'maximum_stage_depth' => $this->faker->randomNumber(3),
            'maximum_stage_height' => $this->faker->randomNumber(3),
            'maximum_seats' => $this->faker->randomNumber(3),
            'maximum_wheelchair_seats' => $this->faker->randomNumber(2),
            'number_of_dressing_rooms' => $this->faker->randomNumber(),
            'backstage_wheelchair_access' => $this->faker->boolean(66)
        ];
    }
}
