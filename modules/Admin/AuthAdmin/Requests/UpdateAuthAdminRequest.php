<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\AuthAdmin\Commands\UpdateAuthAdminCommand;
use Modules\Admin\AuthAdmin\Handlers\UpdateAuthAdminHandler;

class UpdateAuthAdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateAuthAdminCommand(): UpdateAuthAdminCommand
    {
        return new UpdateAuthAdminCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
