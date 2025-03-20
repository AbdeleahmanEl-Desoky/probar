<?php

declare(strict_types=1);

namespace Modules\Barber\ShopService\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\ShopService\Commands\UpdateShopServiceCommand;
use Modules\Barber\ShopService\Handlers\UpdateShopServiceHandler;

class UpdateShopServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateShopServiceCommand(): UpdateShopServiceCommand
    {
        return new UpdateShopServiceCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
