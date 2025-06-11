<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Barber\CoreBarber\Commands\UpdateCfmTokenCommand;
use Ramsey\Uuid\Uuid;

class CfmTokenRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'fcm_token' => 'required',
        ];
    }
    public function updateCfmTokenCommand(): UpdateCfmTokenCommand
    {
        return new UpdateCfmTokenCommand(
            id: Uuid::fromString(auth('api_barbers')->user()->id),
            fcm_token: $this->get('fcm_token'),
        );
    }
}
