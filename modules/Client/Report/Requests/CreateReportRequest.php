<?php

declare(strict_types=1);

namespace Modules\Client\Report\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Client\Report\DTO\CreateReportDTO;

class CreateReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'shop_id'     => 'required|exists:shops,id',
            'schedule_id' => 'required|exists:schedules,id',
            'note'        => 'nullable|string',
        ];
    }

    public function createCreateReportDTO(): CreateReportDTO
    {
        return new CreateReportDTO(
            shop_id: $this->get('shop_id'),
            schedule_id: $this->get('schedule_id'),
            client_id: '', // will be filled later in controller
            note: $this->get('note'),
        );
    }
}
