<?php

declare(strict_types=1);

namespace Modules\Barber\Shop\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\Shop\Commands\UpdateShopCommand;
use Modules\Barber\Shop\Handlers\UpdateShopHandler;

class UpdateShopRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }

    public function createUpdateShopCommand(): UpdateShopCommand
    {
        return new UpdateShopCommand(
            id: Uuid::fromString($this->route('id')),
            latitude: $this->get('latitude'),
            longitude: $this->get('longitude'),
        );
    }
}
