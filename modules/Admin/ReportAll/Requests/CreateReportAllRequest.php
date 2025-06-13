<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ramsey\Uuid\Uuid;
use Modules\Admin\ReportAll\DTO\CreateReportAllDTO;

class CreateReportAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function createCreateReportAllDTO(): CreateReportAllDTO
    {
        return new CreateReportAllDTO(
            name: $this->get('name'),
        );
    }
}
