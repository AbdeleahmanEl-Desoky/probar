<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Services;

use Illuminate\Support\Collection;
use Modules\Admin\FavoriteClient\DTO\CreateFavoriteClientDTO;
use Modules\Admin\FavoriteClient\Models\FavoriteClient;
use Modules\Admin\FavoriteClient\Repositories\FavoriteClientRepository;
use Modules\Client\Favorite\Models\Favorite;
use Ramsey\Uuid\UuidInterface;

class FavoriteClientCRUDService
{
    public function __construct(
        private FavoriteClientRepository $repository,
    ) {
    }

    public function create(CreateFavoriteClientDTO $createFavoriteClientDTO): Favorite
    {
         return $this->repository->createFavoriteClient($createFavoriteClientDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10)
    {
        return $this->repository->paginateds(
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Favorite
    {
        return $this->repository->getFavoriteClient(
            id: $id,
        );
    }
}
