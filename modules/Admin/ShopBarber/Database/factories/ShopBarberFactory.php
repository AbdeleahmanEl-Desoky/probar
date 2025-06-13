<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\ShopBarber\Models\ShopBarber;

/** @extends Factory<ShopBarber> */
class ShopBarberFactory extends Factory
{
    protected $model = ShopBarber::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
