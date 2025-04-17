<?php

declare(strict_types=1);

namespace Modules\Website\Repositories;

use BasePackage\Shared\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\UuidInterface;
use Modules\Website\Models\Website;

/**
 * @property Website $model
 * @method Website findOneOrFail($id)
 * @method Website findOneByOrFail(array $data)
 */
class WebsiteRepository extends BaseRepository
{
    public function __construct(Website $model)
    {
        parent::__construct($model);
    }

    public function getWebsiteList(?int $page, ?int $perPage = 10): Collection
    {
        return $this->paginatedList([], $page, $perPage);
    }

    public function getWebsite(UuidInterface $id): Website
    {
        return $this->findOneByOrFail([
            'id' => $id->toString(),
        ]);
    }

    public function createWebsite(array $data): Website
    {
        return $this->create($data);
    }

    public function updateWebsite(UuidInterface $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deleteWebsite(UuidInterface $id): bool
    {
        return $this->delete($id);
    }
}
