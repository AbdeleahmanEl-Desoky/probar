<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetFavoriteClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
