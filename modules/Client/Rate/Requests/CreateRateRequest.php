<?php

declare(strict_types=1);

namespace Modules\Client\Rate\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Client\Rate\DTO\CreateRateDTO;

class CreateRateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'shop_id'     => 'required|exists:shops,id',
            'schedule_id' => 'required|exists:schedules,id',
            'note'        => 'nullable|string',
            'rate'        => 'required|numeric|min:1|max:5',
        ];
    }

    public function createCreateRateDTO(): CreateRateDTO
    {
        return new CreateRateDTO(
            shop_id: $this->get('shop_id'),
            schedule_id: $this->get('schedule_id'),
            client_id: '', // will be filled later in controller
            note: $this->get('note'),
            rate: $this->get('rate'),
        );
    }
}
