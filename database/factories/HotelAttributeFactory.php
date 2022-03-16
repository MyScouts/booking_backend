<?php

namespace Database\Factories;

use App\Models\HotelAttribute;
use File;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelAttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HotelAttribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $filepath = storage_path('images/hotels');
        if (!File::exists($filepath)) {
            File::makeDirectory($filepath, 0755, true, true);
        }

        return [
            'hotel_id' => $this->faker->numberBetween(1, 50),
            'image_path' => $this->faker->image($filepath, 640, 480, null, false),
            'description' => $this->faker->text(100),
            'like' => $this->faker->randomNumber(),
        ];
    }
}
