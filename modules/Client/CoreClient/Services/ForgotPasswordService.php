<?php

declare(strict_types=1);

namespace Modules\Client\CoreClient\Services;

use Illuminate\Support\Facades\Mail;
use Modules\Client\CoreClient\Models\CoreClient;
use Illuminate\Support\Str;
use Modules\Client\CoreClient\Models\Client;
use Modules\Client\CoreClient\Repositories\CoreClientRepository;

class ForgotPasswordService
{
    public function __construct(
        private CoreClientRepository $repository,
    ) {
    }
    public function generateAndSendOtp(string $email)//: void
    {
        // Retrieve the user by email
        $user = $this->repository->getCoreClientByEmail($email);

        $otp = random_int(100000, 999999); // Or use a numeric OTP, e.g., random_int(100000, 999999);

        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10); // OTP expires in 10 minutes
        $user->save();

        // Send the OTP via email
        Mail::send('emails.forgot_password', ['otp' => $otp], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Your OTP for password reset');
        });
    }
}
