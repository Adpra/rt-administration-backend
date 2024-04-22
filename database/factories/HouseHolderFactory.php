<?php
namespace Database\Factories;

use App\Enums\StatusEnum;
use App\Models\HouseHolder;
use Illuminate\Database\Eloquent\Factories\Factory;

class HouseHolderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $houseId = 1;

        return [
            'name' => $this->faker->name(),
            'photo_ktp' => $this->faker->imageUrl(),
            'status' => StatusEnum::TETAP,
            'marital_status' => StatusEnum::SUDAH_MENIKAH,
            'phone' => $this->faker->phoneNumber(),
            'house_id' => $houseId++,
        ];
    }
}
