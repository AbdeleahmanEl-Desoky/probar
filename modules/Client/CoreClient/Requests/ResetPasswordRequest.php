<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:clients,email', // Ensure the email exists in the clients table
            'otp' => 'required|string|size:6', // OTP must be 6 characters
            'password' => 'required|string|min:6|confirmed', // Password validation
        ];
    }

}
