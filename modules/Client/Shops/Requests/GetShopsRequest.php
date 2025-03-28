<?php

declare(strict_types=1);

namespace Modules\Client\Shops\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetShopsRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
