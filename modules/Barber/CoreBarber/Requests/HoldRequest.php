<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Barber\CoreBarber\Commands\UpdateHoldCommand;
use Ramsey\Uuid\Uuid;

class HoldRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'hold' => 'required',
        ];
    }
    public function updateHoldCommand(): UpdateHoldCommand
    {
        return new UpdateHoldCommand(
            id: Uuid::fromString(auth('api_barbers')->user()->id),
            hold: $this->get('hold'),
        );
    }
}
