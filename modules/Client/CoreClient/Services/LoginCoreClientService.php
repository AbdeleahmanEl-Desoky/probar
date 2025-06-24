<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Services;

use Modules\Client\CoreClient\Repositories\CoreClientRepository;
use Modules\Client\CoreClient\Commands\LoginCoreClientCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginCoreClientService
{

    public function login(LoginCoreClientCommand $command): array
    {
        $credentials = [
            'email' => $command->getEmail(),
            'password' => $command->getPassword(),
        ];

        // Attempt login
        if (!$token = auth('api_clients')->attempt($credentials)) {
            throw new \Exception('Unauthorized: Invalid email or password.', 401);
        }

        $user = auth('api_clients')->user();

        // Check if account is active
        if ($user->is_active != 1) {
            auth('api_clients')->logout();

            throw new \Exception('Your account is inactive. Please contact support.', 403);
        }

        // Return token and user
        return [$this->respondWithToken($token), $user];
    }

    protected function respondWithToken(string $token)
    {
        return  $token;
    }
}
