<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Client\CoreClient\Commands\UpdateCoreClientCommand;
use Modules\Client\CoreClient\Handlers\UpdateCoreClientHandler;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ];
    }
}
