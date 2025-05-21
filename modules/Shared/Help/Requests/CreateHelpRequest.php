<?php

declare(strict_types=1);

namespace Modules\Shared\Help\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Shared\Help\DTO\CreateHelpDTO;

class CreateHelpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email'=> 'required|email',
                
            'message'=> 'required|string',
            'type' => 'required|string',

        ];
    }

    public function createCreateHelpDTO(): CreateHelpDTO
    {
        return new CreateHelpDTO(
            name: $this->get('name'),
            email: $this->get('email'),
            message: $this->get('message'),
            type: $this->get('type'),
        );
    }
}
