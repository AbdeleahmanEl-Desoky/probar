<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ForgotPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:clients,email',
        ];
    }

}
