<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\Shop\DTO\CreateShopDTO;

class CreateShopRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateShopDTO(): CreateShopDTO
    {
        return new CreateShopDTO(
            name: $this->get('name'),
        );
    }
}
