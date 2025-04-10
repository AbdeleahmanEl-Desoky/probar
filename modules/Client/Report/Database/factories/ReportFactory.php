<?php

declare(strict_types=1);

namespace Modules\Client\Report\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Client\Report\Models\Report;

/** @extends Factory<Report> */
class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
