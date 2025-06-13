<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\ShopBarber\DTO\CreateShopBarberDTO;

class CreateShopBarberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateShopBarberDTO(): CreateShopBarberDTO
    {
        return new CreateShopBarberDTO(
            name: $this->get('name'),
        );
    }
}
