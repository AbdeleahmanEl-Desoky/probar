<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\Services;

use Illuminate\Support\Collection;
use Modules\Client\Favorite\DTO\CreateFavoriteDTO;
use Modules\Client\Favorite\Models\Favorite;
use Modules\Client\Favorite\Repositories\FavoriteRepository;
use Ramsey\Uuid\UuidInterface;

class FavoriteCRUDService
{
    public function __construct(
        private FavoriteRepository $repository,
    ) {
    }

    public function create(CreateFavoriteDTO $createFavoriteDTO): Favorite
    {
         return $this->repository->createOrDeleteFavorite($createFavoriteDTO->toArray());
    }

    public function list(int $page = 1, int $perPage = 10): array
    {
        return $this->repository->paginated(
            [ 'client_id' => auth('api_clients')->user()->id],
            page: $page,
            perPage: $perPage,
        );
    }

    public function get(UuidInterface $id): Favorite
    {
        return $this->repository->getFavorite(
            id: $id,
        );
    }
}
