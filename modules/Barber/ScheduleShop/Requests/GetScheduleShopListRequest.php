<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetScheduleShopListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => 'nullable|date',
            'end_date'   => 'nullable|date|after_or_equal:start_date',
            'page'       => 'nullable|integer|min:1',
            'per_page'   => 'nullable|integer|min:1',
        ];
    }
}
