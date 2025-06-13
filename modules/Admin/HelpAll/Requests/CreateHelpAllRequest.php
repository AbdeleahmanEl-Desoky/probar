<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\HelpAll\DTO\CreateHelpAllDTO;

class CreateHelpAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateHelpAllDTO(): CreateHelpAllDTO
    {
        return new CreateHelpAllDTO(
            name: $this->get('name'),
        );
    }
}
