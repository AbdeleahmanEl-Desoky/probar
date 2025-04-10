<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\ScheduleShop\DTO\CreateScheduleShopDTO;

class CreateScheduleShopRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateScheduleShopDTO(): CreateScheduleShopDTO
    {
        return new CreateScheduleShopDTO(
            name: $this->get('name'),
        );
    }
}
