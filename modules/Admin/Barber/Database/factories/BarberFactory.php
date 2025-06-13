<?php

declare(strict_types=1);

namespace Modules\Admin\Barber\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\Barber\Models\Barber;

/** @extends Factory<Barber> */
class BarberFactory extends Factory
{
    protected $model = Barber::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
