<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Client\Favorite\Commands\UpdateFavoriteCommand;
use Modules\Client\Favorite\Handlers\UpdateFavoriteHandler;

class UpdateFavoriteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateFavoriteCommand(): UpdateFavoriteCommand
    {
        return new UpdateFavoriteCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
