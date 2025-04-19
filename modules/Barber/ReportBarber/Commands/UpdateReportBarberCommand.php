<?php

declare(strict_types=1);

namespace Modules\Barber\ReportBarber\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateReportBarberCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $name,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
        ]);
    }
}
