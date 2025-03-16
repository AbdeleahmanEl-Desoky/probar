<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetShopRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
