<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\ReportAll\Commands\UpdateReportAllCommand;
use Modules\Admin\ReportAll\Handlers\UpdateReportAllHandler;

class UpdateReportAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createUpdateReportAllCommand(): UpdateReportAllCommand
    {
        return new UpdateReportAllCommand(
            id: Uuid::fromString($this->route('id')),
            name: $this->get('name'),
        );
    }
}
