<?php

declare(strict_types=1);

namespace Modules\Client\AuthClient\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Client\AuthClient\Models\AuthClient;

/** @extends Factory<AuthClient> */
class AuthClientFactory extends Factory
{
    protected $model = AuthClient::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
