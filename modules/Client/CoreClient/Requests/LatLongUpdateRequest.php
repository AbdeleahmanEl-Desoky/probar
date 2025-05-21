<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Client\CoreClient\Commands\UpdateClientLatLongCommand;
use Ramsey\Uuid\Uuid;

class LatLongUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ];
    }

    public function toCommand(): UpdateClientLatLongCommand
    {
        return new UpdateClientLatLongCommand(
            id: Uuid::fromString(auth('api_clients')->user()->id),
            latitude: (float) $this->get('latitude'),
            longitude: (float) $this->get('longitude'),
        );
    }
}
