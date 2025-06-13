<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\FavoriteClient\DTO\CreateFavoriteClientDTO;

class CreateFavoriteClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateFavoriteClientDTO(): CreateFavoriteClientDTO
    {
        return new CreateFavoriteClientDTO(
            name: $this->get('name'),
        );
    }
}
