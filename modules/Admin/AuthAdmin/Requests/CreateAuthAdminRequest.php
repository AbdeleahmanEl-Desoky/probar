<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\AuthAdmin\DTO\CreateAuthAdminDTO;

class CreateAuthAdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateAuthAdminDTO(): CreateAuthAdminDTO
    {
        return new CreateAuthAdminDTO(
            name: $this->get('name'),
        );
    }
}
