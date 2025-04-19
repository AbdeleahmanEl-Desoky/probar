<?php

declare(strict_types=1);

namespace Modules\Barber\ReportBarber\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Barber\ReportBarber\Commands\UpdateReportBarberCommand;
use Modules\Barber\ReportBarber\Handlers\UpdateReportBarberHandler;

class UpdateReportBarberRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateReportBarberCommand(): UpdateReportBarberCommand
    {
        return new UpdateReportBarberCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
