<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\ShopsHour\Models\ShopsHour;

/** @extends Factory<ShopsHour> */
class ShopsHourFactory extends Factory
{
    protected $model = ShopsHour::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
