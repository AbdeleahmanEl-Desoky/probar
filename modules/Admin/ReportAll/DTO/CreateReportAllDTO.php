<?php

declare(strict_types=1);

namespace Modules\Admin\ReportAll\DTO;

use Ramsey\Uuid\UuidInterface;

class CreateReportAllDTO
{
    public function __construct(
        public string $name,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
