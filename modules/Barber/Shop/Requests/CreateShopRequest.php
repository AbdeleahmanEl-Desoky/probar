<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Barber\Shop\DTO\CreateShopDTO;

class CreateShopRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|array',
            'name.*' => 'nullable|string|max:255',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string|max:255',
            'worker_no' => 'nullable|numeric|min:1|max:500',
            'city_id' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'address_1' => 'nullable|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'file' => 'nullable|array',
            'file.*' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
            'whatsapp' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'hold' => 'nullable|min:0',
        ];
    }

    public function createCreateShopDTO(): CreateShopDTO
    {
        return new CreateShopDTO(
            name: $this->filled('name') ? $this->get('name') : null,
            description: $this->filled('description') ? $this->get('description') : null,
            worker_no: $this->filled('worker_no') ? (int) $this->get('worker_no') : null,
            city_id: $this->filled('city_id') ? $this->get('city_id') : null,
            street: $this->filled('street') ? $this->get('street') : null,
            address_1: $this->filled('address_1') ? $this->get('address_1') : null,
            address_2: $this->filled('address_2') ? $this->get('address_2') : null,
            latitude: $this->filled('latitude') ? (float) $this->input('latitude') : null,
            longitude: $this->filled('longitude') ? (float) $this->input('longitude') : null,
            whatsapp: $this->filled('whatsapp') ? $this->get('whatsapp') : null,
            facebook: $this->filled('facebook') ? $this->get('facebook') : null,
            instagram: $this->filled('instagram') ? $this->get('instagram') : null,
            hold: $this->filled('hold') ? (int) $this->get('hold') : null,
        );
    }
}
