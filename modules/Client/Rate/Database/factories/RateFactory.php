<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Client\Rate\Models\Rate;

/** @extends Factory<Rate> */
class RateFactory extends Factory
{
    protected $model = Rate::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
