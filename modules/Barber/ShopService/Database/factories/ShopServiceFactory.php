<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Barber\ShopService\Models\ShopService;

/** @extends Factory<ShopService> */
class ShopServiceFactory extends Factory
{
    protected $model = ShopService::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
