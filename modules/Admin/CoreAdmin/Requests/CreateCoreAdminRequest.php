<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\CoreAdmin\DTO\CreateCoreAdminDTO;

class CreateCoreAdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateCoreAdminDTO(): CreateCoreAdminDTO
    {
        return new CreateCoreAdminDTO(
            name: $this->get('name'),
        );
    }
}
