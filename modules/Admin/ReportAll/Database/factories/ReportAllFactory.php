<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\ReportAll\Models\ReportAll;

/** @extends Factory<ReportAll> */
class ReportAllFactory extends Factory
{
    protected $model = ReportAll::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
