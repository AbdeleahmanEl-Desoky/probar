<?php

declare(strict_types=1);

namespace Modules\Barber\ShopHour\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\ShopHour\Commands\UpdateShopHourCommand;
use Modules\Barber\ShopHour\Handlers\UpdateShopHourHandler;

class UpdateShopHourRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateShopHourCommand(): UpdateShopHourCommand
    {
        return new UpdateShopHourCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
