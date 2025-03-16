<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Services;

use Modules\Barber\CoreBarber\Repositories\CoreBarberRepository;
use Modules\Barber\CoreBarber\Commands\LoginCoreBarberCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginCoreBarberService
{

    public function login(LoginCoreBarberCommand $command): array
    {
        $credentials = [
            'email' => $command->getEmail(),
            'password' => $command->getPassword(),
        ];

        // Attempt login
        if (!$token = auth('api')->attempt($credentials)) {
            throw new \Exception('Unauthorized: Invalid email or password.', 401);
        }
        // Get the authenticated user
        $user = auth('api')->user();
        // Return the token and user
        return [$this->respondWithToken($token), $user];
    }

    protected function respondWithToken(string $token)
    {

        return  $token;
    }
}
