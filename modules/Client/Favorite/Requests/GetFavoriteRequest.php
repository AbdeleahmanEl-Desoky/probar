<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class GetFavoriteRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
