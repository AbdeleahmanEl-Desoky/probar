<?php

declare(strict_types=1);

namespace Modules\Barber\ScheduleShop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Barber\ScheduleShop\DTO\CreateScheduleDTO;
use Ramsey\Uuid\Uuid;

use function Laravel\Prompts\note;

class CreateScheduleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_time' => 'required',
            'end_time' => 'required',
            'schedule_date' => 'required',
            'status' => 'required|string|in:pending,approved,canceled',
            'note' => 'nullable|string',
            'services' => 'required|array',
            'services.*' => 'uuid|exists:shop_services,id',
            'guest_name'  => 'required|string|max:255',
            'guest_phone' => [
                'required',
                'regex:/^05\d{8}$/',
            ],
        ];
    }

    public function createCreateScheduleDTO(): CreateScheduleDTO
    {
        return new CreateScheduleDTO(
            start_time:$this->get('start_time'),
            end_time:$this->get('end_time'),
            schedule_date:$this->get('schedule_date'),
            shop_id:'',// will be filled later in controller,,
            status:$this->get('status'),
            note:$this->get('note'),
            services: $this->get('services'),
            guest_name: $this->get('guest_name'),
            guest_phone: $this->get('guest_phone')
        );
    }
}
