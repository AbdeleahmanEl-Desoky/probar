<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Client\Favorite\Models\Favorite;

/** @extends Factory<Favorite> */
class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
