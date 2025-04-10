<?php

declare(strict_types=1);

namespace Modules\Client\Report\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
