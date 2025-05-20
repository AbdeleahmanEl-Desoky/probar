<?php

declare(strict_types=1);

namespace Modules\Shared\Help\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Shared\Help\Models\Help;

/**
 * @property Help $model
 * @method Help findOneOrFail($id)
 * @method Help findOneByOrFail(array $data)
 */
class HelpRepository extends BaseRepository
{
    public function __construct(Help $model)
    {
        parent::__construct($model);
    }

    public function getHelpList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getHelp(UuidInterface $id): Help
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createHelp(array $data): Help
    {
        return $this->create($data);
    }

    public function updateHelp(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteHelp(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}
