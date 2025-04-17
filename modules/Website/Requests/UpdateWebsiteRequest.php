<?php

declare(strict_types=1);

namespace Modules\Website\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Website\Commands\UpdateWebsiteCommand;
use Modules\Website\Handlers\UpdateWebsiteHandler;

class UpdateWebsiteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateWebsiteCommand(): UpdateWebsiteCommand
    {
        return new UpdateWebsiteCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
