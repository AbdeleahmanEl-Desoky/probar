<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Services;

use Illuminate\Support\Facades\Hash;
use Modules\Client\CoreClient\Models\CoreClient;
use Illuminate\Support\Str;
use Modules\Client\CoreClient\Repositories\CoreClientRepository;

class ResetPasswordService
{
    public function __construct(
        private CoreClientRepository $repository,
    ) {
    }

    /**
     * Handle the password reset.
     *
     * @param string $email
     * @param string $otp
     * @param string $password
     * @return string
     * @throws \Exception
     */
    public function resetPassword(string $email, string $otp, string $password): string
    {
        // Retrieve the user by email
        $user = $this->repository->getCoreClientByEmail($email);

        if (!$user) {
            throw new \Exception('User not found', 404);
        }

        if ($user->otp !== $otp) {
            throw new \Exception('Invalid OTP', 400);
        }

        if ($user->otp_expires_at < now()) {
            throw new \Exception('OTP has expired', 400);
        }

        // OTP is valid, update password
        $user->password = Hash::make($password); // Using Hash for secure password storage
        $user->otp = null; // Clear OTP after successful reset
        $user->save();

        return 'Password has been successfully reset.';
    }
}
