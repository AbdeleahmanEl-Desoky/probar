<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteShopServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
