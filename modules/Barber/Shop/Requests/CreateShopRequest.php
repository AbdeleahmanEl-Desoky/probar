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
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'description' => 'required|array',  // 'description' is an array of translations
            'description.*' => 'required|string|max:255', // Each translation must be a string
            'worker_no' => 'required|numeric|min:1|max:500',
            'city_id'=> 'required|string|max:255',
            'street'=> 'required|string|max:255',
            'address_1'=> 'required|string|max:255',
            'address_2'=> 'nullable|string|max:255',
            'file' => 'nullable|array',
            'file.*' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'longitude'=> 'nullable',
            'latitude'=> 'nullable',
        ];
    }

    public function createCreateShopDTO(): CreateShopDTO
    {
        return new CreateShopDTO(
            name: $this->get('name'),
            description: $this->get('description'),
            worker_no: (int) $this->get('worker_no'),
            city_id: $this->get('city_id'),
            street: $this->get('street'),
            address_1: $this->get('address_1'),
            address_2: $this->get('address_2') ?? null,
            latitude: $this->input('latitude') !== null ? (float) $this->input('latitude') : null,
            longitude: $this->input('longitude') !== null ? (float) $this->input('longitude') : null
        );
    }
}
