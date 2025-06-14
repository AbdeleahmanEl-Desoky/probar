<?php

declare(strict_types=1);

namespace Modules\Barber\CoreBarber\Commands;

use Ramsey\Uuid\UuidInterface;

class UpdateHoldCommand
{
    public function __construct(
        private UuidInterface $id,
        private string $hold,
    ) {
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }


    public function toArray(): array
    {
        return array_filter([
            'hold' => $this->hold,
        ]);
    }
}
