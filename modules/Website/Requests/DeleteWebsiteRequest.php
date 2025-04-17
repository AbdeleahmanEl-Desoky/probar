<?php

declare(strict_types=1);

namespace Modules\Website\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteWebsiteRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
