<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Client\CoreClient\Models\CoreClient;

/** @extends Factory<CoreClient> */
class CoreClientFactory extends Factory
{
    protected $model = CoreClient::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
