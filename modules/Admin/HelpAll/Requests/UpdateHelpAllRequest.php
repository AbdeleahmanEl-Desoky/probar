<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\HelpAll\Commands\UpdateHelpAllCommand;
use Modules\Admin\HelpAll\Handlers\UpdateHelpAllHandler;

class UpdateHelpAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateHelpAllCommand(): UpdateHelpAllCommand
    {
        return new UpdateHelpAllCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
