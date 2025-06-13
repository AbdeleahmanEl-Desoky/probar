<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\RateAll\Models\RateAll;

/** @extends Factory<RateAll> */
class RateAllFactory extends Factory
{
    protected $model = RateAll::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
