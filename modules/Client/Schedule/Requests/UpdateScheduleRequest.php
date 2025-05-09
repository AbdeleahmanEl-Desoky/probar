<?php

declare(strict_types=1);

namespace Modules\Client\Schedule\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Client\Schedule\Commands\UpdateScheduleCommand;
use Modules\Client\Schedule\Handlers\UpdateScheduleHandler;

class UpdateScheduleRequest extends FormRequest
{
    public function rules(): array
    {
        return [


        ];
    }

    public function createUpdateScheduleCommand(): UpdateScheduleCommand
    {
        return new UpdateScheduleCommand(
            id: Uuid::fromString($this->route('id')),
            status: $this->input('status', 'cancel'),
        );
    }
}
