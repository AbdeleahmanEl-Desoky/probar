<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Shared\Notification\DTO\CreateNotificationDTO;

class CreateNotificationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateNotificationDTO(): CreateNotificationDTO
    {
        return new CreateNotificationDTO(
            name: $this->get('name'),
        );
    }
}
