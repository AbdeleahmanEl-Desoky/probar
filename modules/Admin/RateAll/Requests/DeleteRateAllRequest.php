<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteRateAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
