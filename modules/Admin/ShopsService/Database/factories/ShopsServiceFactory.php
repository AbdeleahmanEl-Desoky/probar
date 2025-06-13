<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\ShopsService\Models\ShopsService;

/** @extends Factory<ShopsService> */
class ShopsServiceFactory extends Factory
{
    protected $model = ShopsService::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
