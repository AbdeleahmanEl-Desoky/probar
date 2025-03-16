<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Barber\CoreBarber\Models\Barber;

/** @extends Factory<Barber> */
class CoreBarberFactory extends Factory
{
    protected $model = Barber::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
