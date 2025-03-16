<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\CoreBarber\Commands\UpdateCoreBarberCommand;
use Modules\Barber\CoreBarber\Handlers\UpdateCoreBarberHandler;
use function Laravel\Prompts\password;

class UpdateCoreBarberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:barbers,email,'. auth('api')->user()->id,
            'password'=>'nullable'
        ];
    }

    public function createUpdateCoreBarberCommand(): UpdateCoreBarberCommand
    {

        return new UpdateCoreBarberCommand(
            id: Uuid::fromString(auth('api')->user()->id),
            name: $this->get('name'),
            email:$this->get('email'),
            password:$this->get('password')?? null,
        );
    }
}
