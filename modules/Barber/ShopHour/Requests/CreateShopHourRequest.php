<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\ShopHour\DTO\CreateShopHourDTO;

class CreateShopHourRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'custom_hours' => 'nullable|array',
            'default_hours.opening_time' => 'nullable|date_format:H:i',
            'default_hours.closing_time' => 'nullable|date_format:H:i|after:default_hours.opening_time',
        ];
    }

    public function createCreateShopHourDTO(): CreateShopHourDTO
    {
        return new CreateShopHourDTO(
            custom_hours: $this->input('custom_hours', []),
            opening_time: $this->input('default_hours.opening_time'),
            closing_time: $this->input('default_hours.closing_time'),
        );
    }
}
