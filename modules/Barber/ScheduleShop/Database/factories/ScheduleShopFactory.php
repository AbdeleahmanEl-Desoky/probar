<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Barber\ScheduleShop\Models\ScheduleShop;

/** @extends Factory<ScheduleShop> */
class ScheduleShopFactory extends Factory
{
    protected $model = ScheduleShop::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
