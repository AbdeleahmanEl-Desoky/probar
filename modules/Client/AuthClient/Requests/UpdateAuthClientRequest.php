<?php

declare(strict_types=1);

namespace Modules\Client\AuthClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Client\AuthClient\Commands\UpdateAuthClientCommand;
use Modules\Client\AuthClient\Handlers\UpdateAuthClientHandler;

class UpdateAuthClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateAuthClientCommand(): UpdateAuthClientCommand
    {
        return new UpdateAuthClientCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
