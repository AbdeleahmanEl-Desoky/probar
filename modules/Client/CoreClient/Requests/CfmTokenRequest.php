<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Client\CoreClient\Commands\UpdateCoreClientCfmToken;
use Ramsey\Uuid\Uuid;
use Modules\Client\CoreClient\Commands\UpdateCoreClientCommand;
use Modules\Client\CoreClient\Handlers\UpdateCoreClientHandler;

class CfmTokenRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cfm_token' => 'required',
        ];
    }
    public function updateCoreClientCfmTokenCommand(): UpdateCoreClientCfmToken
    {
        return new UpdateCoreClientCfmToken(
            id: Uuid::fromString(auth('api_clients')->user()->id),
            cfmToken: $this->get('cfm_token'),
        );
    }
}
