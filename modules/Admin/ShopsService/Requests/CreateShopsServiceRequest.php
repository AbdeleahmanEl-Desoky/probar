<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\ShopsService\DTO\CreateShopsServiceDTO;

class CreateShopsServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateShopsServiceDTO(): CreateShopsServiceDTO
    {
        return new CreateShopsServiceDTO(
            name: $this->get('name'),
        );
    }
}
