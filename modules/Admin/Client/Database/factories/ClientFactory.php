<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\Client\Models\Client;

/** @extends Factory<Client> */
class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
