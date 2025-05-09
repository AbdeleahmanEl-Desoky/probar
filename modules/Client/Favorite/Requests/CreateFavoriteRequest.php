<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Client\Favorite\DTO\CreateFavoriteDTO;

class CreateFavoriteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'shop_id' => 'required',
        ];
    }

    public function createCreateFavoriteDTO(): CreateFavoriteDTO
    {
        return new CreateFavoriteDTO(
            shop_id: $this->get('shop_id'),
            client_id: auth()->user()->id,
        );
    }
}
