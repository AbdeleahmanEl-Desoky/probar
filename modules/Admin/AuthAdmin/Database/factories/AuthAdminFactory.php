<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\AuthAdmin\Models\AuthAdmin;

/** @extends Factory<AuthAdmin> */
class AuthAdminFactory extends Factory
{
    protected $model = AuthAdmin::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
