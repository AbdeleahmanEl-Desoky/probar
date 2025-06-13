<?php

declare(strict_types=1);

namespace Modules\Admin\FavoriteClient\Handlers;

use Modules\Admin\FavoriteClient\Repositories\FavoriteClientRepository;
use Ramsey\Uuid\UuidInterface;

class DeleteFavoriteClientHandler
{
    public function __construct(
        private FavoriteClientRepository $repository,
    ) {
    }

    public function handle(UuidInterface $id)
    {
        $this->repository->deleteFavoriteClient($id);
    }
}
