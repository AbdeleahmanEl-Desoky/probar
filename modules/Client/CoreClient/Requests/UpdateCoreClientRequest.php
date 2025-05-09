<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Client\CoreClient\Commands\UpdateCoreClientCommand;
use Modules\Client\CoreClient\Handlers\UpdateCoreClientHandler;

class UpdateCoreClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateCoreClientCommand(): UpdateCoreClientCommand
    {
        return new UpdateCoreClientCommand(
            id: Uuid::fromString(auth('api_clients')->user()->id),
            name: $this->get('name'),
            email:$this->get('email'),
            phone: $this->get('phone'),
            password:$this->get('password')?? null,
            file:$this->file('file')?? null,
        );
    }
}
