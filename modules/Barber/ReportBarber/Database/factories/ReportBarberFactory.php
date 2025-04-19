<?php

declare(strict_types=1);

namespace Modules\Barber\ReportBarber\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Barber\ReportBarber\Models\ReportBarber;

/** @extends Factory<ReportBarber> */
class ReportBarberFactory extends Factory
{
    protected $model = ReportBarber::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
