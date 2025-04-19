<?php

declare(strict_types=1);

namespace Modules\Barber\ReportBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetReportBarberRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
