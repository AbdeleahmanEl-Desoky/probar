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
            'name' => 'required|string',
            'description' => 'required|string|max:65535',
            'worker_no' => 'required|numeric|min:1|max:2147483647',
            'city_id'=> 'required|string|max:255',
            'street'=> 'required|string|max:255',
            'address_1'=> 'required|string|max:255',
            'address_2'=> 'nullable|string|max:255',
        ];
    }

    public function createUpdateShopCommand(): UpdateShopCommand
    {
        return new UpdateShopCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
            description: $this->get('description'),
            worker_no: $this->get('worker_no'),
            city_id: $this->get('city_id'),
            street: $this->get('street'),
            address_1: $this->get('address_1'),
            address_2: $this->get('address_2') ?? null,
        );
    }
}
