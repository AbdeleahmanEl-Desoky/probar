<?php

declare(strict_types=1);

namespace Modules\Client\AuthClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetAuthClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
