<?php

declare(strict_types=1);

namespace Modules\Admin\ShopBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\ShopBarber\Commands\UpdateShopBarberCommand;
use Modules\Admin\ShopBarber\Handlers\UpdateShopBarberHandler;

class UpdateShopBarberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateShopBarberCommand(): UpdateShopBarberCommand
    {
        return new UpdateShopBarberCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
