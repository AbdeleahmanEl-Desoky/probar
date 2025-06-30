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
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'description' => 'nullable|array',  // 'description' is an array of translations
            'description.*' => 'required|string|max:255', // Each translation must be a string
            'price' => 'required|numeric',
            'time' => 'required|numeric',
        ];
    }

    public function createCreateShopServiceDTO(): CreateShopServiceDTO
    {
        return new CreateShopServiceDTO(
            $this->get('name'),
            $this->get('description'),
            (int) $this->input('time'), // Ensure time is an integer
            (int) $this->input('price') // Ensure price is an integer
        );
    }
}
