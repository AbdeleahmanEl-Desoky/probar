<?php

declare(strict_types=1);

namespace Modules\Admin\Barber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\Barber\DTO\CreateBarberDTO;

class CreateBarberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateBarberDTO(): CreateBarberDTO
    {
        return new CreateBarberDTO(
            name: $this->get('name'),
        );
    }
}
