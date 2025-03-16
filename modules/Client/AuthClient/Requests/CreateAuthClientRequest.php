<?php

declare(strict_types=1);

namespace Modules\Client\AuthClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Client\AuthClient\DTO\CreateAuthClientDTO;

class CreateAuthClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateAuthClientDTO(): CreateAuthClientDTO
    {
        return new CreateAuthClientDTO(
            name: $this->get('name'),
        );
    }
}
