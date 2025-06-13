<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\ScheduleAll\Models\ScheduleAll;

/** @extends Factory<ScheduleAll> */
class ScheduleAllFactory extends Factory
{
    protected $model = ScheduleAll::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
