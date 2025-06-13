<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\CoreBarber\DTO\CreateCoreBarberDTO;
class CheckPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => ['required', 'string'],
        ];
    }
}
