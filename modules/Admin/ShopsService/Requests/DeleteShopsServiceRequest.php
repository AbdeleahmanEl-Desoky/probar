<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsService\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteShopsServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
