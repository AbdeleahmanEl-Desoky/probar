<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteCoreBarberRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
