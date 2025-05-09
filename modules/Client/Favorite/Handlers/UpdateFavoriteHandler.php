<?php

declare(strict_types=1);

namespace Modules\Client\Favorite\Handlers;

use Modules\Client\Favorite\Commands\UpdateFavoriteCommand;
use Modules\Client\Favorite\Repositories\FavoriteRepository;

class UpdateFavoriteHandler
{
    public function __construct(
        private FavoriteRepository $repository,
    ) {
    }

    public function handle(UpdateFavoriteCommand $updateFavoriteCommand)
    {
        $this->repository->updateFavorite($updateFavoriteCommand->getId(), $updateFavoriteCommand->toArray());
    }
}
