<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\HelpAll\Models\HelpAll;

/**
 * @property HelpAll $model
 * @method HelpAll findOneOrFail($id)
 * @method HelpAll findOneByOrFail(array $data)
 */
class HelpAllRepository extends BaseRepository
{
    public function __construct(HelpAll $model)
    {
        parent::__construct($model);
    }

    public function getHelpAllList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getHelpAll(UuidInterface $id): HelpAll
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createHelpAll(array $data): HelpAll
    {
        return $this->create($data);
    }

    public function updateHelpAll(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteHelpAll(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}
