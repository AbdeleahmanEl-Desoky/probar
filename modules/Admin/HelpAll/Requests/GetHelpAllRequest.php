<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetHelpAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
