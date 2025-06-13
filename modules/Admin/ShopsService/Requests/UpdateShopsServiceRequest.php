<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\ShopsService\Commands\UpdateShopsServiceCommand;
use Modules\Admin\ShopsService\Handlers\UpdateShopsServiceHandler;

class UpdateShopsServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateShopsServiceCommand(): UpdateShopsServiceCommand
    {
        return new UpdateShopsServiceCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
