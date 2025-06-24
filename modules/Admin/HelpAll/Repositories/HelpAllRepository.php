<?php

declare(strict_types=1);

namespace Modules\Admin\HelpAll\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Admin\HelpAll\Models\HelpAll;
use Modules\Shared\Help\Models\Help;

/**
 * @property Help $model
 * @method Help findOneOrFail($id)
 * @method Help findOneByOrFail(array $data)
 */
class HelpAllRepository extends BaseRepository
{
    public function __construct(Help $model)
    {
        parent::__construct($model);
    }

    public function getHelpAllList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }
    public function paginateds(int $page = 1, int $perPage = 10)
    {
        return Help::query()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
    }
    public function getHelpAll(UuidInterface $id): Help
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createHelpAll(array $data): Help
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
