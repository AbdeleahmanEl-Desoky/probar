<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetShopHourRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
