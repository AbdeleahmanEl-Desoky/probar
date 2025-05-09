<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\Handlers;

use Modules\Client\Favorite\Repositories\FavoriteRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteFavoriteHandler
{
    public function __construct(
        private FavoriteRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteFavorite($id);
    }
}
