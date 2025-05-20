<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Shared\Notification\Commands\UpdateNotificationCommand;
use Modules\Shared\Notification\Handlers\UpdateNotificationHandler;

class UpdateNotificationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateNotificationCommand(): UpdateNotificationCommand
    {
        return new UpdateNotificationCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
