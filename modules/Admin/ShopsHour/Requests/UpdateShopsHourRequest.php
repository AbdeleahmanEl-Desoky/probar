<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\ShopsHour\Commands\UpdateShopsHourCommand;
use Modules\Admin\ShopsHour\Handlers\UpdateShopsHourHandler;

class UpdateShopsHourRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateShopsHourCommand(): UpdateShopsHourCommand
    {
        return new UpdateShopsHourCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
