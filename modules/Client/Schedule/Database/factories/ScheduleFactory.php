<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Client\Schedule\Models\Schedule;

/** @extends Factory<Schedule> */
class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
