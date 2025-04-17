<?php

declare(strict_types=1);

namespace Modules\Website\Services;

use Illuminate\Support\Collection;
use Modules\Website\DTO\CreateWebsiteDTO;
use Modules\Website\Models\Website;
use Modules\Website\Repositories\WebsiteRepository;
use Ramsey\Uuid\UuidInterface;

class WebsiteCRUDService
{
    public function __construct(
        private WebsiteRepository $repository,
    ) {
    }

    public function create(CreateWebsiteDTO $createWebsiteDTO): Website
    {
         return $this->repository->createWebsite($createWebsiteDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Website
    {
        return $this->repository->getWebsite(
            id: $id,
        );
    }
}
