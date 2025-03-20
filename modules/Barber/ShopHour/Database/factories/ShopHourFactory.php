<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Barber\ShopHour\Models\ShopHour;

/** @extends Factory<ShopHour> */
class ShopHourFactory extends Factory
{
    protected $model = ShopHour::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
