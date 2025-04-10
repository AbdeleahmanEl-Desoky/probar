<?php

declare(strict_types=1);

namespace Modules\Client\Report\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Client\Report\Commands\UpdateReportCommand;
use Modules\Client\Report\Handlers\UpdateReportHandler;

class UpdateReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateReportCommand(): UpdateReportCommand
    {
        return new UpdateReportCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
