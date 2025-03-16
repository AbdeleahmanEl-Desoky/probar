<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Client\CoreClient\DTO\CreateCoreClientDTO;

class CreateCoreClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateCoreClientDTO(): CreateCoreClientDTO
    {
        return new CreateCoreClientDTO(
            name: $this->get('name'),
        );
    }
}
