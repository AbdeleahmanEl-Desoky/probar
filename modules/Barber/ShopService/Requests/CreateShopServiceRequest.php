<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\ShopService\DTO\CreateShopServiceDTO;

class CreateShopServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateShopServiceDTO(): CreateShopServiceDTO
    {
        return new CreateShopServiceDTO(
            name: $this->get('name'),
        );
    }
}
