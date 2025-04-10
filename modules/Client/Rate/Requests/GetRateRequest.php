<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetRateRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
