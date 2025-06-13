<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteFavoriteClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
