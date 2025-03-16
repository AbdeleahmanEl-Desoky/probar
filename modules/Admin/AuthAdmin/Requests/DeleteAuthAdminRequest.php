<?php

declare(strict_types=1);

namespace Modules\Admin\AuthAdmin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteAuthAdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
