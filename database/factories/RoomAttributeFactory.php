<?php

namespace Database\Factories;

use App\Models\RoomAttribute;
use File;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomAttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoomAttribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $filepath = storage_path('images/rooms');
        if (!File::exists($filepath)) {
            File::makeDirectory($filepath, 0755, true, true);
        }

        return [
            'room_id' => $this->faker->numberBetween(1, 100),
            'image_path' => $this->faker->image($filepath, 640, 480, null, false),
            'description' => $this->faker->text(100),
            'like' => $this->faker->randomNumber(),
        ];
    }
}
