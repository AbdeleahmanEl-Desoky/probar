<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\ScheduleAll\Commands\UpdateScheduleAllCommand;
use Modules\Admin\ScheduleAll\Handlers\UpdateScheduleAllHandler;

class UpdateScheduleAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateScheduleAllCommand(): UpdateScheduleAllCommand
    {
        return new UpdateScheduleAllCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
