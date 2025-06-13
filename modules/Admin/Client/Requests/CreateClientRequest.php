<?php

declare(strict_types=1);

namespace Modules\Admin\Client\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\Client\DTO\CreateClientDTO;

class CreateClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateClientDTO(): CreateClientDTO
    {
        return new CreateClientDTO(
            name: $this->get('name'),
        );
    }
}
