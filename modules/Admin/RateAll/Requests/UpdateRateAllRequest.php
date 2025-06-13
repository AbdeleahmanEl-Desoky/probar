<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\RateAll\Commands\UpdateRateAllCommand;
use Modules\Admin\RateAll\Handlers\UpdateRateAllHandler;

class UpdateRateAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateRateAllCommand(): UpdateRateAllCommand
    {
        return new UpdateRateAllCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
