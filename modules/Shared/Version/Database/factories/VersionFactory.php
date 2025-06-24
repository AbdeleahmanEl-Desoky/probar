<?php

declare(strict_types=1);

namespace Modules\Shared\Version\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Shared\Version\Models\Version;

/** @extends Factory<Version> */
class VersionFactory extends Factory
{
    protected $model = Version::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
