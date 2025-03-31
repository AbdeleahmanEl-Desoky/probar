<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Client\CoreClient\Commands\LoginCoreClientCommand;

class LoginCoreClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ];
    }

    public function toCommand(): LoginCoreClientCommand
    {
        return new LoginCoreClientCommand(
            email: $this->get('email'),
            password: $this->get('password')
        );
    }
}
