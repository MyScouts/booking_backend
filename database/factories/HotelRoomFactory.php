<?php

namespace Database\Factories;

use App\Models\HotelRoom;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelRoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HotelRoom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hotel_id' => $this->faker->numberBetween(1, 50),
            'price' => $this->faker->randomDigit(),
            'unit' => $this->faker->randomDigit(),
            'room_id' => $this->faker->unique()->word(),
            'description' => $this->faker->text(100),
            'rating' => $this->faker->randomNumber(),
            'people_of_room' => $this->faker->numberBetween(1, 5),
            'total_bed' => $this->faker->numberBetween(1, 3),
            'category' => $this->faker->jobTitle(),
        ];
    }
}
