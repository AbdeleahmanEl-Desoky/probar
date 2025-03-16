<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\CoreBarber\DTO\CreateCoreBarberDTO;

class CreateCoreBarberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:barbers,email',
            'password'=>'required|string',
        ];
    }

    public function createCreateCoreBarberDTO(): CreateCoreBarberDTO
    {
        return new CreateCoreBarberDTO(
            name: $this->get('name'),
            email:$this->get('email'),
            password:$this->get('password'),
        );
    }
}
