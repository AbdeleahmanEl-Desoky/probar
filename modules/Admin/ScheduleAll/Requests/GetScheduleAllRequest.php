<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetScheduleAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
