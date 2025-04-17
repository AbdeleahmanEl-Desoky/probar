<?php

declare(strict_types=1);

namespace Modules\Website\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Website\DTO\CreateWebsiteDTO;

class CreateWebsiteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateWebsiteDTO(): CreateWebsiteDTO
    {
        return new CreateWebsiteDTO(
            name: $this->get('name'),
        );
    }
}
