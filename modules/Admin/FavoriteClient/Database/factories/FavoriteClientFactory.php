<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\FavoriteClient\Models\FavoriteClient;

/** @extends Factory<FavoriteClient> */
class FavoriteClientFactory extends Factory
{
    protected $model = FavoriteClient::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
