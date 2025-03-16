<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Barber\Shop\Models\Shop;

/** @extends Factory<Shop> */
class ShopFactory extends Factory
{
    protected $model = Shop::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
