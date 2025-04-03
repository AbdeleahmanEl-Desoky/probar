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
            'start_time' => 'required',
            'end_time' => 'required',
            'schedule_date' => 'required',
            'shop_id' => 'required',
            'client_id' => 'required',
            'status' => 'required',
            'note' => 'required',
        ];
    }

    public function createUpdateScheduleCommand(): UpdateScheduleCommand
    {
        return new UpdateScheduleCommand(
            id: Uuid::fromString($this->route('id')),
            start_time:$this->get('start_time'),
            end_time:$this->get('end_time'),
            schedule_date:$this->get('schedule_date'),
            shop_id:$this->get('shop_id'),
            client_id:$this->get('client_id'),
            status:$this->get('status'),
            note:$this->get('note'),
        );
    }
}
