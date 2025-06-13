<?php

declare(strict_types=1);

namespace Modules\Admin\ShopsHour\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\ShopsHour\DTO\CreateShopsHourDTO;

class CreateShopsHourRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateShopsHourDTO(): CreateShopsHourDTO
    {
        return new CreateShopsHourDTO(
            name: $this->get('name'),
        );
    }
}
