<?php

declare(strict_types=1);

namespace Modules\Admin\RateAll\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\RateAll\DTO\CreateRateAllDTO;

class CreateRateAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateRateAllDTO(): CreateRateAllDTO
    {
        return new CreateRateAllDTO(
            name: $this->get('name'),
        );
    }
}
