<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Barber\CoreBarber\Commands\LoginCoreBarberCommand;

class LoginCoreBarberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ];
    }

    public function toCommand(): LoginCoreBarberCommand
    {
        return new LoginCoreBarberCommand(
            email: $this->get('email'),
            password: $this->get('password')
        );
    }
}
