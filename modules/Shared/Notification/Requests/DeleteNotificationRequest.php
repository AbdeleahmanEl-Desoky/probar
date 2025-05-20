<?php

declare(strict_types=1);

namespace Modules\Shared\Notification\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;

class DeleteNotificationRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
