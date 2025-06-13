<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Services;

use Illuminate\Support\Collection;
use Modules\Admin\FavoriteClient\DTO\CreateFavoriteClientDTO;
use Modules\Admin\FavoriteClient\Models\FavoriteClient;
use Modules\Admin\FavoriteClient\Repositories\FavoriteClientRepository;
use Ramsey\Uuid\UuidInterface;

class FavoriteClientCRUDService
{
    public function __construct(
        private FavoriteClientRepository $repository,
    ) {
    }

    public function create(CreateFavoriteClientDTO $createFavoriteClientDTO): FavoriteClient
    {
         return $this->repository->createFavoriteClient($createFavoriteClientDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): FavoriteClient
    {
        return $this->repository->getFavoriteClient(
            id: $id,
        );
    }
}
