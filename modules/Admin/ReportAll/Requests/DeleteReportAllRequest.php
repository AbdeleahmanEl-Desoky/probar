<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteReportAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
