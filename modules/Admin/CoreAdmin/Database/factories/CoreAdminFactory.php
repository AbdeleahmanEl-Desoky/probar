<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\CoreAdmin\Models\User;

/** @extends Factory<User> */
class CoreAdminFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
