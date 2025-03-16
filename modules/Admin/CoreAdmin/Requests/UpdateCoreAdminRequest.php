<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\CoreAdmin\Commands\UpdateCoreAdminCommand;
use Modules\Admin\CoreAdmin\Handlers\UpdateCoreAdminHandler;

class UpdateCoreAdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateCoreAdminCommand(): UpdateCoreAdminCommand
    {
        return new UpdateCoreAdminCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
