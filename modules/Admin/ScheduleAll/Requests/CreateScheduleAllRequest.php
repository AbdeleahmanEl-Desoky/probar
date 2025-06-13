<?php

declare(strict_types=1);

namespace Modules\Admin\ScheduleAll\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\ScheduleAll\DTO\CreateScheduleAllDTO;

class CreateScheduleAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateScheduleAllDTO(): CreateScheduleAllDTO
    {
        return new CreateScheduleAllDTO(
            name: $this->get('name'),
        );
    }
}
