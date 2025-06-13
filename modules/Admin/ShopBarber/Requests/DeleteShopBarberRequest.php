<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteShopBarberRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
