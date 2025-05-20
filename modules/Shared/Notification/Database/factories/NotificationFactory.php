<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Shared\Notification\Models\Notification;

/** @extends Factory<Notification> */
class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
