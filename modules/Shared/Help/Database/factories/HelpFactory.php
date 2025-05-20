<?php

declare(strict_types=1);

namespace Modules\Shared\Help\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Shared\Help\Models\Help;

/** @extends Factory<Help> */
class HelpFactory extends Factory
{
    protected $model = Help::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
