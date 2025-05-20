<?php

declare(strict_types=1);

namespace Modules\Shared\Help\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Shared\Help\Commands\UpdateHelpCommand;
use Modules\Shared\Help\Handlers\UpdateHelpHandler;

class UpdateHelpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateHelpCommand(): UpdateHelpCommand
    {
        return new UpdateHelpCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
