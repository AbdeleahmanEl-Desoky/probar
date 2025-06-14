<?php

declare(strict_types=1);

namespace Modules\Admin\Barber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\Barber\Commands\UpdateBarberCommand;
use Modules\Admin\Barber\Handlers\UpdateBarberHandler;

class UpdateStutesBarberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
        ];
    }

}
