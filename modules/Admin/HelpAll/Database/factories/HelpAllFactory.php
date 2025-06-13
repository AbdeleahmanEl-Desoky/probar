<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\HelpAll\Models\HelpAll;

/** @extends Factory<HelpAll> */
class HelpAllFactory extends Factory
{
    protected $model = HelpAll::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
