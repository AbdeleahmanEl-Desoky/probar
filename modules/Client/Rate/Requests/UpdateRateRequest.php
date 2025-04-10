<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Client\Rate\Commands\UpdateRateCommand;
use Modules\Client\Rate\Handlers\UpdateRateHandler;

class UpdateRateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateRateCommand(): UpdateRateCommand
    {
        return new UpdateRateCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
