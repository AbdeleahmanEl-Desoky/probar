<?php

declare(strict_types=1);

namespace Modules\Website\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Website\Models\Website;

/** @extends Factory<Website> */
class WebsiteFactory extends Factory
{
    protected $model = Website::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
