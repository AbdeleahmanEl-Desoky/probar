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
            'email' => 'required|email|unique:barbers,email,'. auth('api_barbers')->user()->id,
            'password'=>'nullable',
            'phone' =>  [
                'required',
                'regex:/^05\d{8}$/',
                'unique:barbers,phone,' . auth('api_barbers')->user()->id,
            ],
            'hold' => 'nullable|numeric|min:0',
        ];
    }

    public function createUpdateCoreBarberCommand(): UpdateCoreBarberCommand
    {

        return new UpdateCoreBarberCommand(
            id: Uuid::fromString(auth('api_barbers')->user()->id),
            name: $this->get('name'),
            email:$this->get('email'),
            phone: $this->get('phone'),
            password:$this->get('password')?? null,
            file:$this->file('file')?? null,
            hold: $this->get('hold') ?? null
        );
    }
}
