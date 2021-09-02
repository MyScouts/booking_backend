<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hotel::class;

    /**
     * Define the model's default state.
     *
     *
     * @return array
     */
    public function definition()
    {
        $time = ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '08:00', '09:00', '10:00', '11:00', '12:00'];

        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->text(100),
            'phone_number' => $this->faker->regexify('09[0-9]{9}'),
            'address' => $this->faker->address(),
            'open_time' => $this->faker->randomElement($time),
            'close_time' => $this->faker->randomElement($time),
            'rating' => $this->faker->randomNumber(),
            'medium_price' => $this->faker->randomDigit(),
            'unit' => $this->faker->randomDigit(),
            'post_code' => $this->faker->postcode(),
            'information' => $this->faker->text(100),
        ];
    }
}
