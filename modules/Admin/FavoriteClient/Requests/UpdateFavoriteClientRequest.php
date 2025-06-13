<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\FavoriteClient\Commands\UpdateFavoriteClientCommand;
use Modules\Admin\FavoriteClient\Handlers\UpdateFavoriteClientHandler;

class UpdateFavoriteClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateFavoriteClientCommand(): UpdateFavoriteClientCommand
    {
        return new UpdateFavoriteClientCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
