<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\ScheduleShop\Commands\UpdateScheduleShopCommand;
use Modules\Barber\ScheduleShop\Handlers\UpdateScheduleShopHandler;

class UpdateScheduleShopRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateScheduleShopCommand(): UpdateScheduleShopCommand
    {
        return new UpdateScheduleShopCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
