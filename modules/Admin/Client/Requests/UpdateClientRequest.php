<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\Client\Commands\UpdateClientCommand;
use Modules\Admin\Client\Handlers\UpdateClientHandler;

class UpdateClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateClientCommand(): UpdateClientCommand
    {
        return new UpdateClientCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
