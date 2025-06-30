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
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'description' => 'nullable|array',  // 'description' is an array of translations
            'description.*' => 'nullable|string|max:255', // Each translation must be a string
            'price' => 'required|numeric',
            'time' => 'required|numeric',
        ];
    }

    public function createUpdateShopServiceCommand(): UpdateShopServiceCommand
    {
        return new UpdateShopServiceCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->input('name', []), // Ensure array format
            description: $this->input('description', []), // Ensure array format
            price: (int) $this->input('price'), // Convert to integer
            time: (int) $this->input('time'), // Convert to integer
            shop_id: $this->input('shop_id') // Ensure shop_id is included
        );
    }

}
