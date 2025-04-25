<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Barber\ScheduleShop\Commands\UpdateScheduleShopStatusCommand;
use Ramsey\Uuid\Uuid;

class UpdateScheduleShopStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => 'required|in:status,pending,waiting,on_process,finished',
        ];
    }

    public function updateScheduleShopStatusCommand(): UpdateScheduleShopStatusCommand
    {
        return new UpdateScheduleShopStatusCommand(
            id: Uuid::fromString($this->route('id')),
            status: $this->get('status'),
        );
    }
}
