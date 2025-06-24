<?php

declare(strict_types=1);

namespace Modules\Shared\Version\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetVersionRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
