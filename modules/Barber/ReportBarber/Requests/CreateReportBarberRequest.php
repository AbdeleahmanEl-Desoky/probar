<?php

declare(strict_types=1);

namespace Modules\Barber\ReportBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\ReportBarber\DTO\CreateReportBarberDTO;

class CreateReportBarberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'schedule_id' => 'required|exists:schedules,id',
            'note'        => 'nullable|string',
        ];
    }

    public function createCreateReportBarberDTO(): CreateReportBarberDTO
    {
        return new CreateReportBarberDTO(
            shop_id: '',// will be filled later in controller,
            schedule_id: $this->get('schedule_id'),
            user_id: '', // will be filled later in controller
            type: 'barber',
            note: $this->get('note'),
        );
    }
}
