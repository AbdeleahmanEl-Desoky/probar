<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Services;

use Illuminate\Support\Facades\Mail;
use Modules\Barber\CoreBarber\Models\CoreBarber;
use Illuminate\Support\Str;
use Modules\Barber\CoreBarber\Models\Barber;
use Modules\Barber\CoreBarber\Repositories\CoreBarberRepository;

class ForgotPasswordService
{
    public function __construct(
        private CoreBarberRepository $repository,
    ) {
    }
    public function generateAndSendOtp(string $email)//: void
    {
        // Retrieve the user by email
        $user = $this->repository->getCoreBarberByEmail($email);

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
