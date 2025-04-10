<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetScheduleShopRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
