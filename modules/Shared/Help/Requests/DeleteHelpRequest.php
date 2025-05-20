<?php

declare(strict_types=1);

namespace Modules\Shared\Help\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteHelpRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
