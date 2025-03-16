<?php

declare(strict_types=1);

namespace Modules\Admin\CoreAdmin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetCoreAdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
