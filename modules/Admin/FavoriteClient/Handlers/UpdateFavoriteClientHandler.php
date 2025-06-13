<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Handlers;

use Modules\Admin\FavoriteClient\Commands\UpdateFavoriteClientCommand;
use Modules\Admin\FavoriteClient\Repositories\FavoriteClientRepository;

class UpdateFavoriteClientHandler
{
    public function __construct(
        private FavoriteClientRepository $repository,
    ) {
    }

    public function handle(UpdateFavoriteClientCommand $updateFavoriteClientCommand)
    {
        $this->repository->updateFavoriteClient($updateFavoriteClientCommand->getId(), $updateFavoriteClientCommand->toArray());
    }
}
